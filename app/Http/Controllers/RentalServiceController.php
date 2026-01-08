<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Faq;
use App\Models\Product;
use App\Models\RentalService;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RentalServiceController extends Controller
{
    use UploadImageTrait;

    /**
     * Display the Rental Service page
     */
    public function index()
    {
        try {
            // Fetch the first record
            $data = RentalService::first();

            // Return view with data
            return view('pages.rental_services.index', compact('data'));
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('RentalService index error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            // Return view with empty data and error message
            return view('pages.rental_services.index', [
                'data' => null,
                'general_error' => 'Unable to fetch rental service data. Please try again later.'
            ]);
        }
    }

    /**
     * Store or update Rental Service with transaction and proper error handling
     */
    public function store(Request $request)
    {
        DB::beginTransaction(); // Start DB transaction

        try {
            // Validation
            $request->validate([
                'hero_title' => 'required|string|max:255',
                'hero_subtitle' => 'nullable|string',
                'main_heading' => 'nullable|string|max:255',
                'main_description' => 'nullable|string',
                'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB
                'main_image_alt' => 'nullable|string|max:255',
                'equipment_heading' => 'nullable|string|max:255',
                'equipment_list' => 'nullable|string',
                'why_rent_heading' => 'nullable|string|max:255',
                'why_rent_list' => 'nullable|string',
                'meta_title' => 'nullable|string|max:255',
                'meta_keywords' => 'nullable|string',
                'meta_description' => 'nullable|string',
            ]);

            // Check if update or create
            if ($request->id) {
                $rentalService = RentalService::findOrFail($request->id);
                $rentalService->updated_by = Auth::id();
            } else {
                $rentalService = new RentalService();
                $rentalService->created_by = Auth::id();
            }

            // Fill fields
            $rentalService->hero_title = $request->hero_title;
            $rentalService->hero_subtitle = $request->hero_subtitle;
            $rentalService->main_heading = $request->main_heading;
            $rentalService->main_description = $request->main_description;
            $rentalService->main_image = $this->updateImage(
                $request,
                'main_image',
                'rental_services',
                $rentalService->main_image ?? null
            );
            $rentalService->main_image_alt = $request->main_image_alt;
            $rentalService->equipment_heading = $request->equipment_heading;
            $rentalService->equipment_list = $request->equipment_list;
            $rentalService->why_rent_heading = $request->why_rent_heading;
            $rentalService->why_rent_list = $request->why_rent_list;
            $rentalService->meta_title = $request->meta_title;
            $rentalService->meta_keywords = $request->meta_keywords;
            $rentalService->meta_description = $request->meta_description;

            $rentalService->save();

            DB::commit(); // Commit transaction

            // Success message
            $message = $request->id ? 'Rental Service updated successfully.' : 'Rental Service created successfully.';
            return redirect()->back()->with('success', $message);
        } catch (\Illuminate\Validation\ValidationException $ve) {
            DB::rollBack(); // Rollback DB changes on validation failure
            return redirect()->back()->withErrors($ve->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback DB changes on any other exception

            // Log the error for debugging
            Log::error('RentalService store/update error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            // Return back with a general error message
            return redirect()->back()->withInput()->withErrors([
                'general_error' => 'Something went wrong! Please try again.',
            ]);
        }
    }

    public function landingPage()
    {
        try {
            // Fetch rental service main data
            $data = RentalService::first();

            // Fetch active products
            $products = Product::where('is_active', true)
                ->select(['name', 'slug', 'short_description', 'description', 'thumbnail', 'gallery_images', 'image_alt'])
                ->paginate(8);

            // Merge images
            $products = merge_images($products, 'thumbnail', 'gallery_images', 'all_images');

            // Fetch FAQs
            $faqs = getFaqs('rental');

            
        } catch (\Exception $e) {

            // Log the error for debugging
            Log::error("Landing Page Error: " . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            // Fallback empty data (so the view never breaks)
            $data = null;
            $products = collect();
            $faqs = collect();
            $blogs = collect();
        }

        // Return view with safe variables
        return view('frontend.pages.rental', compact('data', 'products', 'faqs'));
    }
}
