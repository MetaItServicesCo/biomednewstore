<?php

namespace App\Http\Controllers;

use App\DataTables\RepairServicesSubPageDataTable;
use App\Models\Faq;
use App\Models\RepairService;
use App\Models\RepairServiceSubPage;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RepairServiceController extends Controller
{
    use UploadImageTrait;

    public function index()
    {
        try {
            // Permission check
            $this->authorize('read repair service');

            // Fetch data
            $data = RepairService::first();

            return view('pages.repair-service.index', compact('data'));
        } catch (\Throwable $e) {
            Log::error('Repair Service Index Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->back()
                ->with('error', 'Something went wrong while loading repair service data.');
        }
    }

    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'main_heading' => 'required|string|max:255',
            'main_short_description' => 'nullable|string',
            'banner_heading' => 'nullable|string|max:255',
            'banner_short_description' => 'nullable|string',
            'banner_image' => 'nullable|file|max:10240', // any file up to 10MB
            'banner_image_alt' => 'nullable|string|max:255',

            'repair_service_heading' => 'nullable|string|max:255',
            'repair_service_short_description' => 'nullable|string',   // NEW

            'x_ray_heading' => 'nullable|string|max:255',
            'x_ray_short_description' => 'nullable|string',            //  NEW

            'c_arm_heading' => 'nullable|string|max:255',
            'c_arm_short_description' => 'nullable|string',            // NEW

            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ];

        $validated = $request->validate($rules);

        try {
            DB::beginTransaction();

            // Get first entry or create new
            $repairService = RepairService::first();

            if (!$repairService) {
                $this->authorize('create repair service');
                // Create fresh entry
                $repairService = new RepairService();
                $repairService->created_by = Auth::id(); // set created_by on create
            } else {
                $this->authorize('write repair service');
                // Update existing entry
                $repairService->updated_by = Auth::id(); // set updated_by on update
            }
            // Fill validated data except banner_image
            $repairService->fill($request->except('banner_image'));

            // Handle file upload using the trait
            $repairService->banner_image = $this->updateImage(
                $request,
                'banner_image',
                'repair_services',
                $repairService->banner_image
            );

            $repairService->save();

            DB::commit();

            return redirect()->back()->with('success', 'Repair Service details saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();

            // Log the error
            Log::error('RepairService store error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);

            // Return back with input and show error under the form
            return redirect()->back()
                ->withInput()
                ->withErrors(['general_error' => 'Something went wrong. Please try again or contact support.']);
        }
    }

    public function subPagesList(RepairServicesSubPageDataTable $dataTable)
    {
        try {
            $this->authorize('read repair service sub page');

            return $dataTable->render('pages.repair-service.sub-pages.list');
        } catch (\Throwable $e) {
            Log::error('Repair Service SubPages List Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->back()
                ->with('error', 'Something went wrong while loading repair service sub-pages.');
        }
    }

    public function subPagesCreate()
    {
        try {
            $this->authorize('create repair service sub page');

            return view('pages.repair-service.sub-pages.create');
        } catch (\Throwable $e) {
            Log::error('Repair Service SubPages Create Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()
                ->back()
                ->with('error', 'Something went wrong while opening the create sub-page form.');
        }
    }

    public function subPagesStore(Request $request)
    {
        $this->authorize('create repair service sub page');

        // -------------------------
        // VALIDATION
        // -------------------------
        $validated = $request->validate([
            'page_category'       => 'required|string',
            'title'              => 'required|string|max:255',
            'slug'               => 'required|string|max:255|unique:repair_service_sub_pages,slug',
            'is_active'          => 'required|boolean',

            'short_description'  => 'nullable|string',

            'content_title'      => 'required|string|max:255',
            'content_thumbnail'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:512',
            'content_image_alt'  => 'nullable|string|max:255',

            'gallery_images.*'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:512',

            'content_description' => 'nullable|string',

            'serve_heading'       => 'nullable|string',
            'serve_description'   => 'nullable|string',

            'benefits_heading'    => 'nullable|string',
            'benefits_description' => 'nullable|string',

            'challenges_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:300',
            'challenges_image_alt'    => 'nullable|string|max:255',
            'challenges_description'  => 'nullable|string',

            'cta_thumbnail'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:300',
            'cta_image_alt'       => 'nullable|string|max:255',
            'cta_description'     => 'nullable|string',

            // SEO
            'meta_title'        => 'nullable|string|max:255',
            'meta_keywords'     => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // -------------------------
            // IMAGE UPLOADS
            // --------------------------
            $challengesImage = null;
            if ($request->hasFile('challenges_image')) {
                $challengesImage = $this->uploadImage($request->file('challenges_image'), 'repair-pages');
            }

            $contentThumbnail = null;
            if ($request->hasFile('content_thumbnail')) {
                $contentThumbnail = $this->uploadImage($request->file('content_thumbnail'), 'repair-pages');
            }

            $ctaThumbnail = null;
            if ($request->hasFile('cta_thumbnail')) {
                $ctaThumbnail = $this->uploadImage($request->file('cta_thumbnail'), 'repair-pages');
            }

            // -------------------------
            // MULTIPLE GALLERY IMAGES
            // -------------------------
            $galleryImages = [];
            if ($request->hasFile('gallery_images')) {
                foreach ($request->file('gallery_images') as $img) {
                    $galleryImages[] = $this->uploadImage($img, 'repair-pages/gallery');
                }
            }

            // -------------------------
            // INSERT INTO DB
            // -------------------------
            $page = RepairServiceSubPage::create([
                'page_category'        => $validated['page_category'],
                'title'                => $validated['title'],
                'slug'                 => Str::slug($validated['slug']),
                'is_active'            => $validated['is_active'] ?? 1,

                'short_description'    => $validated['short_description'] ?? null,

                'content_title'        => $validated['content_title'],
                'content_thumbnail'    => $contentThumbnail,
                'content_image_alt'    => $validated['content_image_alt'] ?? null,

                'gallery_images'       => json_encode($galleryImages),

                'content_description'  => $validated['content_description'] ?? null,

                'serve_heading'        => $validated['serve_heading'] ?? null,
                'serve_description'    => $validated['serve_description'] ?? null,

                'benefits_heading'     => $validated['benefits_heading'] ?? null,
                'benefits_description' => $validated['benefits_description'] ?? null,

                'challenges_image'            => $challengesImage,
                'challenges_image_alt'        => $validated['challenges_image_alt'] ?? null,
                'challenges_description'      => $validated['challenges_description'] ?? null,

                'cta_thumbnail'        => $ctaThumbnail,
                'cta_image_alt'        => $validated['cta_image_alt'] ?? null,
                'cta_description'      => $validated['cta_description'] ?? null,

                'meta_title'           => $validated['meta_title'] ?? null,
                'meta_keywords'        => $validated['meta_keywords'] ?? null,
                'meta_description'     => $validated['meta_description'] ?? null,

                'created_by'           => Auth::id(),
            ]);

            DB::commit();

            return redirect()
                ->route('admin-repair-service.sub-pages.list')
                ->with('success', 'Page created successfully!');
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()
                ->withErrors(['error' => 'Something went wrong: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function subPagesEdit($id)
    {
        try {
            $this->authorize('write repair service sub page');

            // Find the subpage by ID
            $subPage = RepairServiceSubPage::findOrFail($id);

            // Pass the data to the view
            return view('pages.repair-service.sub-pages.create', ['data' => $subPage]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // If the subpage with given ID is not found
            return redirect()->route('repair-service.sub-pages.list')
                ->with('error', 'Subpage not found.');
        } catch (\Exception $e) {
            // Handle other possible errors
            return redirect()->route('repair-service.sub-pages.list')
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function removeGalleryImage(Request $request)
    {
        $this->authorize('write repair service sub page');

        // Validate input
        $request->validate([
            'id' => 'required|exists:repair_service_sub_pages,id',
            'image' => 'required|string',
        ]);

        $subPage = RepairServiceSubPage::findOrFail($request->id);

        // Decode existing gallery images
        $galleryImages = json_decode($subPage->gallery_images, true) ?? [];

        if (!in_array($request->image, $galleryImages)) {
            return response()->json([
                'success' => false,
                'message' => 'Image not found in this Repair Sub Page.'
            ]);
        }

        // Remove image from array
        $galleryImages = array_filter($galleryImages, fn($img) => $img !== $request->image);

        // Save updated JSON
        $subPage->gallery_images = json_encode(array_values($galleryImages));
        $subPage->save();

        // Delete image from storage
        if (Storage::exists('public/repair-pages/gallery/' . $request->image)) {
            Storage::delete('public/repair-pages/gallery/' . $request->image);
        }

        // Return JSON with success message
        return response()->json([
            'success' => true,
            'message' => 'Image has been removed successfully.'
        ]);
    }

    public function subPagesUpdate(Request $request, $id)
    {
        $this->authorize('write repair service sub page');

        // ------------------------- 
        // VALIDATION 
        // ------------------------- 
        $validated = $request->validate([
            'page_category' => 'required|string',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:repair_service_sub_pages,slug,' . $id,
            'is_active' => 'required|boolean',
            'short_description' => 'nullable|string',
            'content_title' => 'required|string|max:255',
            'content_thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:300',
            'content_image_alt' => 'nullable|string|max:255',
            'gallery_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:300',
            'content_description' => 'nullable|string',
            'serve_heading' => 'nullable|string',
            'serve_description' => 'nullable|string',
            'benefits_heading' => 'nullable|string',
            'benefits_description' => 'nullable|string',

            'challenges_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:300',
            'challenges_image_alt'    => 'nullable|string|max:255',
            'challenges_description'  => 'nullable|string',

            'cta_thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:300',
            'cta_image_alt' => 'nullable|string|max:255',
            'cta_description' => 'nullable|string',
            // SEO 
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);
        try {
            DB::beginTransaction();
            // ------------------------- 
            // Find existing page 
            // ------------------------- 

            $page = RepairServiceSubPage::findOrFail($id);

            // ------------------------- 
            // IMAGE UPDATES 
            // ------------------------- 

            $contentThumbnail = $this->updateImage($request, 'content_thumbnail', 'repair-pages', $page->content_thumbnail);
            $challengesImage = $this->updateImage($request, 'challenges_image', 'repair-pages', $page->challenges_image);
            $ctaThumbnail = $this->updateImage($request, 'cta_thumbnail', 'repair-pages', $page->cta_thumbnail);

            // ------------------------- 
            // MULTIPLE GALLERY IMAGES 
            // ------------------------- 

            $existingGallery = json_decode($page->gallery_images, true) ?? [];
            if ($request->hasFile('gallery_images')) {
                $existingGallery = $this->uploadMultipleImages($existingGallery, $request->file('gallery_images'), 'repair-pages/gallery');
            }

            // ------------------------- 
            // UPDATE DB 
            // ------------------------- 
            $page->update([
                'page_category'         => $validated['page_category'],
                'title'                 => $validated['title'],
                'slug'                  => Str::slug($validated['slug']),
                'is_active'             => $validated['is_active'] ?? 1,
                'short_description'     => $validated['short_description'] ?? null,
                'content_title'         => $validated['content_title'],
                'content_thumbnail'     => $contentThumbnail,
                'content_image_alt'     => $validated['content_image_alt'] ?? null,
                'gallery_images'        => json_encode($existingGallery),
                'content_description'   => $validated['content_description'] ?? null,
                'serve_heading'         => $validated['serve_heading'] ?? null,
                'serve_description'     => $validated['serve_description'] ?? null,
                'benefits_heading'      => $validated['benefits_heading'] ?? null,
                'benefits_description'  => $validated['benefits_description'] ?? null,

                'challenges_image'            => $challengesImage,
                'challenges_image_alt'        => $validated['challenges_image_alt'] ?? null,
                'challenges_description'      => $validated['challenges_description'] ?? null,

                'cta_thumbnail'         => $ctaThumbnail,
                'cta_image_alt'         => $validated['cta_image_alt'] ?? null,
                'cta_description'       => $validated['cta_description'] ?? null,
                'meta_title'            => $validated['meta_title'] ?? null,
                'meta_keywords'         => $validated['meta_keywords'] ?? null,
                'meta_description'      => $validated['meta_description'] ?? null,
                'updated_by'            => Auth::id(),
            ]);
            DB::commit();
            return redirect()->route('admin-repair-service.sub-pages.list')->with('success', 'Page updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Something went wrong: ' . $e->getMessage()])->withInput();
        }
    }

    public function subPagesDestroy($id)
    {
        try {
            $this->authorize('delete repair service sub page');

            DB::beginTransaction();

            // -------------------------
            // Find the Sub Page
            // -------------------------
            $page = RepairServiceSubPage::findOrFail($id);

            // -------------------------
            // Store deleted_by user
            // -------------------------
            $page->deleted_by = Auth::id();
            $page->save();

            // -------------------------
            // Soft Delete the record
            // -------------------------
            $page->delete();

            DB::commit();

            return redirect()
                ->route('admin-repair-service.sub-pages.list')
                ->with('success', 'Page deleted successfully!');
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()
                ->back()
                ->withErrors(['error' => 'Unable to delete the page: ' . $e->getMessage()]);
        }
    }

    public function landingPage()
    {
        // Fetch data
        $data = RepairService::first();
        $faqs = getFaqs('repair');
        return view('frontend.pages.repaire', compact('data', 'faqs'));
    }

    public function repairServiceDetail($category, $slug)
    {
        // dd($category, $slug);

        // Mapping: URL segment → Actual DB page_category value
        $categoryMap = [
            'repairing-services' => 'repair-service',  // URL: repairing-services → DB: repair-service
            'x-ray' => 'x-ray',
            'c-arm' => 'c-arm',

        ];

        // Get the actual DB category from URL segment
        $dbCategory = $categoryMap[$category] ?? $category;

        // Fetch the sub-page using DB category and slug
        $data = RepairServiceSubPage::where('page_category', $dbCategory)
            ->where('slug', $slug)
            ->where('is_active', true)
            ->first();

        // Merge images
        merge_images(
            $data,
            'content_thumbnail',
            'gallery_images',
            'all_images',
            'storage/repair-pages',          // thumbnail path
            'storage/repair-pages/gallery'   // gallery path
        );

        // If page not found → 404
        if (!$data) {
            abort(404, 'The requested service page was not found.');
        }

        $faqs = getFaqs('repair');

        return view('frontend.pages.repair-service-detail', compact('data', 'faqs'));
    }
}
