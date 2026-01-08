<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\LocationPage;
use App\Models\ServingCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LocationPageController extends Controller
{
    public function index()
    {
        try {
            $data = LocationPage::first();
            return view('pages.location_page.index', compact('data'));
        } catch (\Throwable $e) {

            // Log actual error for developers
            Log::error('LocationPage Index Error', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
            ]);

            // Redirect with user-friendly message
            return redirect()
                ->back()
                ->with('error', 'Something went wrong while loading the location page.');
        }
    }

    public function storeOrUpdate(Request $request)
    {
        // ================= Validation =================
        $validatedData = $request->validate([
            'id'                        => 'nullable|exists:location_pages,id',

            // Hero Section
            'hero_title'                => 'required|string|max:255',
            'hero_subtitle'             => 'nullable|string',

            // Areas We Serve
            'areas_title'               => 'nullable|string|max:255',
            'areas_description'         => 'nullable|string',

            // Major Cities
            'cities_section_title'      => 'nullable|string|max:255',

            // How We Serve
            'serve_heading'             => 'nullable|string|max:255',
            'serve_description'         => 'nullable|string',

            // SEO
            'meta_title'                => 'nullable|string|max:255',
            'meta_keywords'             => 'nullable|string|max:255',
            'meta_description'          => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            // ================= Common Data =================
            $data = [
                // Hero
                'hero_title'             => $validatedData['hero_title'],
                'hero_subtitle'          => $validatedData['hero_subtitle'] ?? null,

                // Areas
                'areas_title'            => $validatedData['areas_title'] ?? null,
                'areas_description'      => $validatedData['areas_description'] ?? null,

                // Cities
                'cities_section_title'   => $validatedData['cities_section_title'] ?? null,

                // How We Serve
                'serve_heading'          => $validatedData['serve_heading'] ?? null,
                'serve_description'      => $validatedData['serve_description'] ?? null,

                // SEO
                'meta_title'             => $validatedData['meta_title'] ?? null,
                'meta_keywords'          => $validatedData['meta_keywords'] ?? null,
                'meta_description'       => $validatedData['meta_description'] ?? null,

                // Audit
                'updated_by'             => Auth::id(),
            ];

            if (!empty($validatedData['id'])) {
                // ================= UPDATE =================
                $locationPage = LocationPage::findOrFail($validatedData['id']);
                $locationPage->update($data);
            } else {
                // ================= CREATE =================
                $data['created_by'] = Auth::id();
                $locationPage = LocationPage::create($data);
            }

            DB::commit();

            return redirect()
                ->back()
                ->with(
                    'success',
                    !empty($validatedData['id'])
                        ? 'Location page updated successfully.'
                        : 'Location page created successfully.'
                );
        } catch (\Throwable $e) {

            DB::rollBack();

            // ================= Log Error =================
            Log::error('LocationPage store/update failed', [
                'error_message' => $e->getMessage(),
                'file'          => $e->getFile(),
                'line'          => $e->getLine(),
                'user_id'       => Auth::id(),
                'request_data'  => $request->except(['_token']),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'error' => 'Something went wrong. Please try again.',
                ]);
        }
    }

    public function landingPage()
    {
        try {
            $data = LocationPage::first();
            $servingCities = ServingCity::where('is_active', true)->orderBy('area_name', 'asc')->select([
                'area_name',
                'city_image',
                'city_image_alt',
                'slug',
            ])->get();

            $faqs = getFaqs('location');

            return view('frontend.pages.location', compact('data', 'faqs', 'servingCities'));
        } catch (\Throwable $e) {

            // Log error
            Log::error('Location Landing Page Error', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
            ]);

            // Show friendly error page or redirect
            return redirect()
                ->route('home') // ya ->back()
                ->with('error', 'Unable to load location page at the moment.');
        }
    }

    public function locationDetail($slug)
    {
        try {
            $data = ServingCity::where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();

            $faqs = getFaqs('location');

            $all_categories = Category::select('name', 'slug')
                ->where([
                    'status'      => true,
                ])
                ->get();

            return view('frontend.pages.locationdetail', compact('data', 'faqs', 'all_categories'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Show 404 page instead of redirect
            abort(404, 'The requested location was not found.');
        } catch (\Exception $e) {
            // Log unexpected errors
            Log::error('Error fetching location details:', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('home')->with('error', 'Unable to load location details. Please try again later.');
        }
    }
}
