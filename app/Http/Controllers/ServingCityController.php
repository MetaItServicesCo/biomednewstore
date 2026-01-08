<?php

namespace App\Http\Controllers;

use App\DataTables\ServingCityDataTable;
use App\Models\ServingCity;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServingCityController extends Controller
{
    use UploadImageTrait;

    public function list(ServingCityDataTable $dataTable)
    {
        try {
            return $dataTable->render('pages.serving_cities.index');
        } catch (\Throwable $e) {
            Log::error('Serving City List Page Error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->withErrors(['error' => 'Failed to load the list page.']);
        }
    }

    public function create()
    {
        try {
            return view('pages.serving_cities.create');
        } catch (\Throwable $e) {
            Log::error('Serving City Create Page Error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->withErrors(['error' => 'Failed to load the create page.']);
        }
    }

    public function store(Request $request)
    {
        // ================= VALIDATION =================
        $validated = $request->validate([
            // Hero
            'hero_title'           => 'required|string|max:255',
            'hero_subtitle'        => 'nullable|string',
            'slug'                 => 'required|string|max:255|unique:serving_cities,slug',

            // Status
            'is_active'            => 'required|boolean',

            // City
            'city_name'            => 'required|string|max:255',
            'area_name'            => 'required|string|max:255',
            'show_on_header'       => 'required|boolean',
            'city_image'           => 'required|image|mimes:jpg,jpeg,png,webp|max:300',
            'city_image_alt'       => 'nullable|string|max:255',

            // Content
            'content_title'        => 'nullable|string|max:255',
            'content_description'  => 'nullable|string',
            'image_alt'            => 'nullable|string|max:255',

            // Gallery
            'gallery_images.*'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:300',

            // Serve
            'serve_heading'        => 'nullable|string|max:255',
            'serve_description'    => 'nullable|string',

            // SEO
            'meta_title'           => 'nullable|string|max:255',
            'meta_keywords'        => 'nullable|string|max:255',
            'meta_description'     => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // ================= CREATE =================
            $servingCity = new ServingCity();
            $servingCity->created_by = Auth::id();

            // ================= ASSIGN DATA =================
            $servingCity->fill([
                'hero_title'          => $validated['hero_title'] ?? null,
                'hero_subtitle'       => $validated['hero_subtitle'] ?? null,
                'slug'                => Str::slug($validated['slug']),
                'is_active'           => $validated['is_active'],

                'city_name'           => $validated['city_name'] ?? null,
                'area_name'           => $validated['area_name'] ?? null,
                'show_on_header'      => $validated['show_on_header'] ?? null,
                'city_image_alt'      => $validated['city_image_alt'] ?? null,

                'content_title'       => $validated['content_title'] ?? null,
                'content_description' => $validated['content_description'] ?? null,
                'image_alt'           => $validated['image_alt'] ?? null,

                'serve_heading'       => $validated['serve_heading'] ?? null,
                'serve_description'   => $validated['serve_description'] ?? null,

                'meta_title'          => $validated['meta_title'] ?? null,
                'meta_keywords'       => $validated['meta_keywords'] ?? null,
                'meta_description'    => $validated['meta_description'] ?? null,
            ]);

            // ================= CITY IMAGE UPLOAD =================
            if ($request->hasFile('city_image')) {
                $servingCity->city_image = $this->uploadImage(
                    $request->file('city_image'),
                    'cities'
                );
            }

            // ================= GALLERY UPLOAD =================
            if ($request->hasFile('gallery_images')) {
                $gallery = $this->uploadMultipleImages(
                    [],
                    $request->file('gallery_images'),
                    'cities/gallery'
                );

                $servingCity->gallery_images = json_encode($gallery);
            }

            // ================= SAVE =================
            $servingCity->save();

            DB::commit();

            return redirect()
                ->route('admin.serving-cities.list')
                ->with('success', 'Serving City created successfully.');
        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('Serving City Store Failed', [
                'error'      => $e->getMessage(),
                'file'       => $e->getFile(),
                'line'       => $e->getLine(),
                'user_id'    => Auth::id(),
                'request'    => $request->except(['_token']),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'error' => 'Something went wrong. Please try again.',
                ]);
        }
    }

    public function edit($id)
    {
        try {
            $data = ServingCity::findOrFail($id);
            return view('pages.serving_cities.create', compact('data'));
        } catch (\Throwable $e) {
            Log::error('Serving City Edit Page Error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'city_id' => $id
            ]);

            return back()->withErrors(['error' => 'Failed to load the edit page.']);
        }
    }


    public function update(Request $request, $id)
    {
        // ================= VALIDATION =================
        $validated = $request->validate([
            'hero_title'           => 'required|string|max:255',
            'hero_subtitle'        => 'nullable|string|max:255',
            'slug'                 => 'required|string|max:255|unique:serving_cities,slug,' . $id,
            'is_active'            => 'required|boolean',
            'city_name'            => 'required|string|max:255',
            'area_name'            => 'required|string|max:255',
            'show_on_header'       => 'required|boolean',
            'city_image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:300',
            'city_image_alt'       => 'nullable|string|max:255',
            'content_title'        => 'nullable|string|max:255',
            'content_description'  => 'nullable|string',
            'image_alt'            => 'nullable|string|max:255',
            'gallery_images.*'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:300',
            'serve_heading'        => 'nullable|string|max:255',
            'serve_description'    => 'nullable|string',
            'meta_title'           => 'nullable|string|max:255',
            'meta_keywords'        => 'nullable|string|max:255',
            'meta_description'     => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // ================= FIND =================
            $servingCity = ServingCity::findOrFail($id);
            $servingCity->updated_by = Auth::id();

            // ================= ASSIGN DATA =================
            $servingCity->fill([
                'hero_title'          => $validated['hero_title'] ?? null,
                'hero_subtitle'       => $validated['hero_subtitle'] ?? null,
                'slug'                => $validated['slug'],
                'is_active'           => $validated['is_active'],
                'city_name'           => $validated['city_name'] ?? null,
                'area_name'           => $validated['area_name'] ?? null,
                'show_on_header'      => $validated['show_on_header'] ?? null,
                'city_image_alt'      => $validated['city_image_alt'] ?? null,
                'content_title'       => $validated['content_title'] ?? null,
                'content_description' => $validated['content_description'] ?? null,
                'image_alt'           => $validated['image_alt'] ?? null,
                'serve_heading'       => $validated['serve_heading'] ?? null,
                'serve_description'   => $validated['serve_description'] ?? null,
                'meta_title'          => $validated['meta_title'] ?? null,
                'meta_keywords'       => $validated['meta_keywords'] ?? null,
                'meta_description'    => $validated['meta_description'] ?? null,
            ]);

            // ================= CITY IMAGE UPLOAD =================
            $servingCity->city_image = $this->updateImage(
                $request,
                'city_image',
                'cities',
                $servingCity->city_image
            );

            // ================= GALLERY UPLOAD =================
            $existingGallery = !empty($servingCity->gallery_images)
                ? json_decode($servingCity->gallery_images, true)
                : [];

            if ($request->hasFile('gallery_images')) {
                $gallery = $this->uploadMultipleImages(
                    $existingGallery,
                    $request->file('gallery_images'),
                    'cities/gallery'
                );
                $servingCity->gallery_images = json_encode($gallery);
            }

            // ================= SAVE =================
            $servingCity->save();

            DB::commit();

            return redirect()
                ->route('admin.serving-cities.list')
                ->with('success', 'Serving City updated successfully.');
        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('Serving City Update Failed', [
                'error'   => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'user_id' => Auth::id(),
                'request' => $request->except(['_token']),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'error' => 'Something went wrong. Please try again.',
                ]);
        }
    }

    public function removeGalleryImage(Request $request)
    {
        // Validate input
        $request->validate([
            'id' => 'required|exists:serving_cities,id',
            'image' => 'required|string',
        ]);

        $city = ServingCity::findOrFail($request->id);

        // Decode existing gallery images
        $galleryImages = json_decode($city->gallery_images, true) ?? [];

        if (!in_array($request->image, $galleryImages)) {
            return response()->json([
                'success' => false,
                'message' => 'Image not found in this city.'
            ]);
        }

        // Remove image from array
        $galleryImages = array_filter($galleryImages, fn($img) => $img !== $request->image);

        // Save updated JSON
        $city->gallery_images = json_encode(array_values($galleryImages));
        $city->save();

        // Delete image from storage
        if (Storage::exists('public/cities/gallery/' . $request->image)) {
            Storage::delete('public/cities/gallery/' . $request->image);
        }

        // Return JSON with success message
        return response()->json([
            'success' => true,
            'message' => 'Image has been removed successfully.'
        ]);
    }


    public function destroy($id)
    {
        DB::beginTransaction();

        $city = ServingCity::findOrFail($id);

        try {
            // Delete city image
            if ($city->city_image && Storage::disk('public')->exists('cities/' . $city->city_image)) {
                Storage::disk('public')->delete('cities/' . $city->city_image);
            }

            // Delete gallery images
            $galleryImages = json_decode($city->gallery_images, true) ?? [];
            foreach ($galleryImages as $image) {
                if (Storage::disk('public')->exists('cities/gallery/' . $image)) {
                    Storage::disk('public')->delete('cities/gallery/' . $image);
                }
            }

            // Delete record
            $city->delete(); // Hard delete

            DB::commit();

            return redirect()->route('admin.serving-cities.list')
                ->with('success', 'Serving City deleted successfully!');
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Serving City Delete Error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'city_id' => $city->id
            ]);

            return back()->withErrors(['error' => 'Failed to delete the Serving City: ' . $e->getMessage()]);
        }
    }
}
