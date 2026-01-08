<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\City;
use App\Models\Faq;
use App\Models\LandingPage;
use App\Models\OemContent;
use App\Models\Offer;
use App\Models\Product;
use App\Models\RepairService;
use App\Models\RepairServiceSubPage;
use App\Traits\UploadImageTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class LandingPageController extends Controller
{
    use UploadImageTrait;

    public function index()
    {
        try {
            $this->authorize('read landing page');

            $data = LandingPage::first();

            return view('pages.landing-page.index', compact('data'));
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            // If user is not authorized
            abort(403, 'You do not have permission to view this page.');
        } catch (\Throwable $e) {
            // Log any other errors
            Log::error('LandingPage index error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            // Redirect back with a friendly error message
            return redirect()->back()->withErrors(['general_error' => 'Unable to load landing page data. Please try again later.']);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        // Validation rules
        $rules = [
            'hero_heading' => 'required|string|max:255',
            'hero_sd' => 'nullable|string',
            'hero_slider_images.*' => 'nullable|file|image|max:10240',
            'hero_image_alt' => 'nullable|string|max:255',
            'content_heading' => 'required|string|max:255',
            'content_description' => 'nullable|string',
            'content_slider_images.*' => 'nullable|file|image|max:10240',
            'content_image_alt' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ];

        $validated = $request->validate($rules);

        try {
            DB::beginTransaction();

            // Fetch first entry or create new
            $landingPage = LandingPage::first();

            if (! $landingPage) {
                $this->authorize('create landing page');
                $landingPage = new LandingPage;
                $landingPage->created_by = auth()->id();
            } else {
                $this->authorize('write landing page');
                $landingPage->updated_by = auth()->id();
            }

            // Fill normal fields
            $landingPage->fill($request->except([
                'hero_slider_images',
                'content_slider_images',
            ]));

            // Handle Hero Slider Images
            if ($request->hasFile('hero_slider_images')) {
                $existingHeroImages = $landingPage->hero_slider_images;
                $existingHeroImages = is_array($existingHeroImages) ? $existingHeroImages : [];
                $landingPage->hero_slider_images = $this->uploadMultipleImages(
                    $existingHeroImages,
                    $request->file('hero_slider_images'),
                    'landing-page/hero-slider'
                );
            }

            // Handle Content Slider Images
            if ($request->hasFile('content_slider_images')) {
                $existingContentImages = $landingPage->content_slider_images;
                $existingContentImages = is_array($existingContentImages) ? $existingContentImages : [];
                $landingPage->content_slider_images = $this->uploadMultipleImages(
                    $existingContentImages,
                    $request->file('content_slider_images'),
                    'landing-page/content-slider'
                );
            }

            $landingPage->save();

            DB::commit();

            $message = $landingPage->wasRecentlyCreated ? 'Landing page created successfully.' : 'Landing page updated successfully.';

            return redirect()->back()->with('success', $message);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            // If user is not authorized
            abort(403, 'You do not have permission to view this page.');
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('LandingPage storeOrUpdate error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all(),
            ]);

            return redirect()->back()
                ->withInput()
                ->withErrors(['general_error' => 'Something went wrong. Please try again or contact support.']);
        }
    }

    public function removeSliderImage(Request $request)
    {
        $this->authorize('delete landing page');

        $request->validate([
            'landing_page_id' => 'required|integer|exists:landing_pages,id',
            'image' => 'required|string',
            'column' => 'required|string',
            'path' => 'required|string', // path of the file relative to storage/app/public
        ]);

        try {
            $landingPage = LandingPage::findOrFail($request->landing_page_id);
            $column = $request->column;
            $imageToRemove = $request->image;
            $path = rtrim($request->path, '/') . '/'; // ensure trailing slash

            // Get existing images as array
            $images = $landingPage->{$column};
            if (! is_array($images)) {
                $images = json_decode($images, true) ?? [];
            }

            // Remove the image from array
            $images = array_filter($images, function ($img) use ($imageToRemove) {
                return $img !== $imageToRemove;
            });

            // Update the column in DB
            $landingPage->{$column} = array_values($images); // reindex array
            $landingPage->save();

            // Delete file from storage
            if (Storage::disk('public')->exists($path . $imageToRemove)) {
                Storage::disk('public')->delete($path . $imageToRemove);
            }

            return response()->json([
                'success' => true,
                'message' => 'Image removed successfully.',
            ]);
        } catch (\Throwable $e) {
            Log::error('removeSliderImage error: ' . $e->getMessage(), [
                'request' => $request->all(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while removing the image.',
            ]);
        }
    }

    public function landingPage()
    {
        // Landing page data

        // Cache landing page data for 1 hour
        $data = Cache::remember('landing_page_data', 3600, function () {
            return LandingPage::select([
                'meta_title',
                'meta_keywords',
                'meta_description',
            ])->first();
        });

        $categories = Cache::remember('landing_page_categories', 3600, function () {
            return Category::where('status', true)->select(['name', 'slug'])->get();
        });

        // $data = LandingPage::select([
        //     'hero_heading',
        //     'hero_sd',
        //     'hero_slider_images',
        //     'hero_image_alt',
        //     'content_heading',
        //     'content_description',
        //     'content_slider_images',
        //     'content_image_alt',
        //     'meta_title',
        //     'meta_keywords',
        //     'meta_description',
        // ])->first();

        // Active categories
        // $categories = Category::where('status', true)
        //     ->select(['name', 'slug'])
        //     ->get();

        // Latest 16 active products
        $products = Product::select([
            'name',
            'slug',
            'short_description',
            'price',
            'discount_percent',
            'sale_price',
            'thumbnail',
            'image_alt',
        ])
            ->where('is_active', true)
            ->whereIn('type', ['for_store', 'both'])
            ->latest()
            ->take(16)
            ->get();
        $faqs = getFaqs('landing');

        return view('frontend.pages.home', compact(
            'data',
            'categories',
            'products',
            'faqs',
        ));
    }

    public function getCities($state_id)
    {
        try {
            // Validate state_id is numeric
            if (!is_numeric($state_id)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid state ID.'
                ], 400);
            }

            // Only fetch ID and name
            $cities = City::where('state_id', $state_id)
                ->orderBy('name', 'asc')
                ->pluck('name', 'id');

            return response()->json([
                'status' => true,
                'data'   => $cities
            ], 200);
        } catch (Exception $e) {

            Log::error('Error fetching cities: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong while fetching cities.'
            ], 500);
        }
    }

    public function filter(Request $request)
    {
        $query = Product::where('is_active', true)
            ->whereIn('type', ['for_store', 'both']);

        // Category tab filter (button click)
        if ($request->category && $request->category !== 'all') {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // SMART SEARCH (Product + Category)
        if ($request->search) {

            $search = $request->search;

            // Search matching categories
            $categoryIds = Category::where('name', 'like', "%{$search}%")
                ->pluck('id')
                ->toArray();

            $query->where(function ($q) use ($search, $categoryIds) {

                // Product name match
                $q->where('name', 'like', "%{$search}%");

                // OR products belonging to matched categories
                if (!empty($categoryIds)) {
                    $q->orWhereIn('category_id', $categoryIds);
                }
            });
        }

        $products = $query->latest()->take(16)->get();

        return response()->json([
            'html' => view('partials.best-products', compact('products'))->render()
        ]);
    }

    public function latestProductsFilter(Request $request)
    {
        $slug = $request->slug;

        // Find category by slug
        $category = null;
        if ($slug) {
            $category = Category::where('slug', $slug)->first();
        }

        // Agar category nahi mili, to empty collection return karo
        if (!$category) {
            return response()->json([
                'html' => view('partials.latest-products', ['products' => collect()])->render()
            ]);
        }

        // Category mil gayi, uske products fetch karo
        $products = Product::where('is_active', true)
            ->where('category_id', $category->id)
            ->latest()
            ->take(4)
            ->get();

        return response()->json([
            'html' => view('partials.latest-products', compact('products'))->render()
        ]);
    }



    // ===========================
    // Store landing page
    // ===========================

    public function storeLandingPage(){
        return view('biomed-store.store-landing-page');
    }
}
