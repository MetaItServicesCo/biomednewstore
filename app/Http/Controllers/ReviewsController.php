<?php

namespace App\Http\Controllers;

use App\DataTables\ReviewsDataTable;
use App\Models\Category;
use App\Models\Review;
use App\Models\ReviewsLandingPage;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Http;

class ReviewsController extends Controller
{
    use UploadImageTrait;

    /**
     * Show review landing page form
     */
    public function index()
    {
        try {
            $data = ReviewsLandingPage::first();

            return view('pages.review.landing', compact('data'));
        } catch (\Throwable $e) {
            Log::error('Review landing page load failed', [
                'error' => $e->getMessage()
            ]);

            return back()->with('error', 'Something went wrong while loading the page.');
        }
    }

    /**
     * Store or Update review landing page
     */
    public function storeOrUpdate(Request $request)
    {
        // ================= VALIDATION =================
        $validated = $request->validate([
            'id' => 'nullable|exists:reviews_landing_pages,id',

            // Hero
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'nullable|string',

            // Main content
            'main_heading' => 'nullable|string|max:255',
            'main_description' => 'nullable|string',
            'main_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'main_image_alt' => 'nullable|string|max:255',

            // CTA
            'cta_title' => 'nullable|string|max:255',
            'cta_description' => 'nullable|string',
            'cta_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_logo_alt' => 'nullable|string|max:255',

            // Testimonials
            'testimonial_heading' => 'nullable|string|max:255',
            'testimonial_subheading' => 'nullable|string',

            // SEO
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // ================= FIND OR CREATE =================
            $page = ReviewsLandingPage::find($request->id) ?? new ReviewsLandingPage();

            // ================= IMAGE UPLOAD =================
            $mainImage = $this->updateImage(
                $request,
                'main_image',
                'reviews/main',
                $page->main_image ?? null
            );

            $ctaLogo = $this->updateImage(
                $request,
                'cta_logo',
                'reviews/cta',
                $page->cta_logo ?? null
            );

            // ================= SAVE DATA =================
            $page->fill([
                // Hero
                'hero_title' => $validated['hero_title'],
                'hero_subtitle' => $validated['hero_subtitle'] ?? null,

                // Main
                'main_heading' => $validated['main_heading'] ?? null,
                'main_description' => $validated['main_description'] ?? null,
                'main_image' => $mainImage,
                'main_image_alt' => $validated['main_image_alt'] ?? null,

                // CTA
                'cta_title' => $validated['cta_title'] ?? null,
                'cta_description' => $validated['cta_description'] ?? null,
                'cta_logo' => $ctaLogo,
                'cta_logo_alt' => $validated['cta_logo_alt'] ?? null,

                // Testimonials
                'testimonial_heading' => $validated['testimonial_heading'] ?? null,
                'testimonial_subheading' => $validated['testimonial_subheading'] ?? null,

                // SEO
                'meta_title' => $validated['meta_title'] ?? null,
                'meta_keywords' => $validated['meta_keywords'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,

                // Audit
                'updated_by' => Auth::id(),
            ]);

            if (! $page->exists) {
                $page->created_by = Auth::id();
            }

            $page->save();

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Review landing page saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Review landing page save failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function landingPage()
    {
        try {
            $data = ReviewsLandingPage::first();

            // Get all categories which have at least 1 approved review
            $categories = Category::select('id', 'name', 'slug')
                ->whereHas('reviews', function ($q) {
                    $q->where('status', 'approved');
                })
                ->orderBy('name', 'asc')
                ->get();

            // dd($categories);

            // Default first category
            $firstCategory = $categories->first();

            // Reviews for first category (paginated 12 per page)
            $reviewsByCategory = $firstCategory
                ? $firstCategory->reviews()->select('id', 'name', 'message', 'rating', 'category_id')->where('status', 'approved')->latest()->paginate(12)
                : new LengthAwarePaginator([], 0, 12);;


            $allCategories = Category::where('status', true)->pluck('name', 'slug');

            $latestReviews = Review::select('name', 'message', 'rating')->where('status', 'approved')->latest()->get();

            return view('frontend.pages.feedback', compact('data', 'categories', 'firstCategory', 'reviewsByCategory', 'allCategories', 'latestReviews'));
        } catch (\Throwable $e) {

            // Log actual error for debugging
            Log::error('Reviews landing page load failed (frontend)', [
                'error' => $e->getMessage(),
                'file'  => $e->getFile(),
                'line'  => $e->getLine(),
            ]);

            // Optional: show page without data instead of 500
            return view('frontend.pages.feedback', [
                'data' => null
            ])->with('error', 'Unable to load feedback page at the moment.');
        }
    }

    /**
     * --------------------------------------------------
     * AJAX: Filter reviews by category
     * --------------------------------------------------
     */
    public function filterReviews(Request $request)
    {
        try {
            $slug = $request->slug;
            $page = $request->page ?? 1;

            $category = Category::where('slug', $slug)->firstOrFail();

            $reviews = $category->reviews()
                ->select('id', 'name', 'message', 'rating', 'category_id')
                ->where('status', 'approved')
                ->latest()
                ->paginate(12, ['*'], 'page', $page);
            return response()->json([
                'html'       => view('partials.review-cards', compact('reviews'))->render(),
                'pagination' => view('partials.review-pagination', compact('reviews'))->render(),
            ]);
        } catch (\Throwable $e) {

            Log::error('Error filtering reviews', [
                'slug' => $request->slug,
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'html' => '<div class="col-12 text-center py-5 text-muted">No reviews found.</div>',
                'pagination' => '',
            ]);
        }
    }


    // ===========================
    // Reviews list and store actions
    // ===========================

    public function list(ReviewsDataTable $dataTable)
    {
        return $dataTable->render('pages.review.list');
    }

    public function store(Request $request)
    {
        /**
         * ---------------------------------------------
         * STEP 1: Validation (including reCAPTCHA)
         * ---------------------------------------------
         */
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|max:255',
            'category' => 'required|exists:categories,slug',
            'message' => 'required|string',
            'rating'  => 'required|integer|min:1|max:5',
            'g-recaptcha-response' => 'required',
        ], [
            'g-recaptcha-response.required' => 'Please confirm you are not a robot.',
        ]);

        /**
         * ---------------------------------------------
         * STEP 2: Verify reCAPTCHA with Google
         * ---------------------------------------------
         */
        $captchaResponse = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'secret'   => config('services.recaptcha.secret'),
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip(),
            ]
        );

        $captchaBody = $captchaResponse->json();

        if (!($captchaBody['success'] ?? false)) {
            throw ValidationException::withMessages([
                'g-recaptcha-response' => ['reCAPTCHA verification failed. Please try again.'],
            ]);
        }

        /**
         * ---------------------------------------------
         * STEP 3: DB Transaction
         * ---------------------------------------------
         */
        DB::beginTransaction();

        try {

            // Fetch category
            $category = Category::where('slug', $validated['category'])->firstOrFail();

            Review::create([
                'name'        => $validated['name'],
                'email'       => $validated['email'],
                'message'     => $validated['message'],
                'category_id' => $category->id,
                'rating'      => $validated['rating'],
                'status'      => 'pending',
                'created_by'  => Auth::check() ? Auth::id() : null,
                'ip_address'  => $request->ip(),
                'user_agent'  => $request->userAgent(),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your feedback!',
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();

            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Feedback submit failed', [
                'error' => $e->getMessage(),
                'file'  => $e->getFile(),
                'line'  => $e->getLine(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.',
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $data = Review::findOrFail($id);

            // Return the edit view with the comment data
            return view('pages.review.edit', compact('data'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // If comment not found, redirect back with an error
            return redirect()->route('admin.feedback.list')
                ->with('error', 'Review comment not found.');
        } catch (\Exception $e) {
            // Log unexpected errors
            Log::error('Error fetching review comment for edit:', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('admin.feedback.list')
                ->with('error', 'Unable to load review comment. Please try again later.');
        }
    }

    public function update(Request $request, $id)
    {
        /**
         * ---------------------------------------------
         * STEP 1: Validate incoming request
         * - On failure: redirects back with errors
         * - Old input preserved automatically
         * ---------------------------------------------
         */
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string',
            'rating'  => 'required|integer|min:1|max:5',
            'status'  => 'required|in:pending,approved,rejected',
        ]);

        /**
         * ---------------------------------------------
         * STEP 2: Start DB Transaction
         * ---------------------------------------------
         */
        DB::beginTransaction();

        try {

            /**
             * ---------------------------------------------
             * STEP 3: Find review or fail
             * ---------------------------------------------
             */
            $review = Review::findOrFail($id);

            /**
             * ---------------------------------------------
             * STEP 4: Update review data
             * ---------------------------------------------
             */
            $review->update([
                'name'       => $validated['name'],
                'email'      => $validated['email'],
                'message'    => $validated['message'],
                'rating'     => $validated['rating'],
                'status'     => $validated['status'],
                'updated_by' => auth()->id(), // null if not logged in
            ]);

            /**
             * ---------------------------------------------
             * STEP 5: Commit DB Transaction
             * ---------------------------------------------
             */
            DB::commit();

            /**
             * ---------------------------------------------
             * STEP 6: Redirect on success
             * ---------------------------------------------
             */
            return redirect()
                ->route('admin.feedback.list')
                ->with('success', 'Review updated successfully.');
        } catch (\Throwable $e) {

            /**
             * ---------------------------------------------
             * STEP 7: Rollback & log error
             * ---------------------------------------------
             */
            DB::rollBack();

            Log::error('Review update failed', [
                'review_id' => $id,
                'error'     => $e->getMessage(),
                'file'      => $e->getFile(),
                'line'      => $e->getLine(),
            ]);

            /**
             * ---------------------------------------------
             * STEP 8: Redirect back with error
             * ---------------------------------------------
             */
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $review = Review::findOrFail($id);
            $review->delete();
            DB::commit();
            return redirect()
                ->back()
                ->with('success', 'Review deleted successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Review delete failed', [
                'review_id' => $id,
                'error'     => $e->getMessage(),
                'file'      => $e->getFile(),
                'line'      => $e->getLine(),
            ]);

            return redirect()
                ->back()
                ->with('error', 'Something went wrong. Unable to delete review.');
        }
    }
}
