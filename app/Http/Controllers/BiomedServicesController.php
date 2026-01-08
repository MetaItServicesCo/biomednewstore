<?php

namespace App\Http\Controllers;

use App\Models\BiomedServices;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Product;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BiomedServicesController extends Controller
{
    use UploadImageTrait;

    /**
     * Show create/update form (single page record).
     */
    public function index()
    {
        try {
            // Is page ka only 1 record hoga
            $data = BiomedServices::first();
        } catch (\Throwable $e) {
            Log::error('Error loading Biomed services page', [
                'error' => $e->getMessage(),
            ]);

            // Agar kuch error ay to blank object pass kar denge
            $data = null;
        }

        return view('pages.biomed_services.index', compact('data'));
    }

    /**
     * Store or update Biomed services page.
     */
    public function store(Request $request)
    {
        // -------- VALIDATION --------
        $validated = $request->validate([
            'id'              => 'nullable|integer|exists:biomed_services,id',
            'hero_title'      => 'required|string|max:255',
            'hero_subtitle'   => 'nullable|string',

            'intro_heading'   => 'nullable|string|max:255',
            'intro_text'      => 'nullable|string',

            'intro_image_1'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:300',
            'intro_image_2'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:300',
            'intro_image_1_alt' => 'nullable|string|max:255',
            'intro_image_2_alt' => 'nullable|string|max:255',

            'product_heading' => 'nullable|string|max:255',

            'banner_heading'  => 'nullable|string|max:255',
            'banner_text'     => 'nullable|string',

            'service_heading' => 'nullable|string|max:255',
            'service_sd'      => 'nullable|string',

            'service_cards'               => 'nullable|array',
            'service_cards.*.heading'     => 'nullable|string|max:255',
            'service_cards.*.description' => 'nullable|string',

            'service_images'                    => 'nullable|array',
            'service_images.*.file'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:300',
            'service_images.*.alt'              => 'nullable|string|max:255',
            'service_images.*.existing_path'    => 'nullable|string',

            'meta_title'       => 'nullable|string|max:255',
            'meta_keywords'    => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            $id = $validated['id'] ?? null;

            // -------- FIND OR CREATE MODEL --------
            if ($id) {
                $biomed = BiomedServices::findOrFail($id);
            } else {
                $biomed = new BiomedServices();
            }

            // -------- BASIC FIELDS (TEXT) --------
            $biomed->hero_title       = $validated['hero_title'];
            $biomed->hero_subtitle    = $validated['hero_subtitle'] ?? null;

            $biomed->intro_heading    = $validated['intro_heading'] ?? null;
            $biomed->intro_text       = $validated['intro_text'] ?? null;

            $biomed->intro_image_1_alt = $validated['intro_image_1_alt'] ?? null;
            $biomed->intro_image_2_alt = $validated['intro_image_2_alt'] ?? null;

            $biomed->product_heading  = $validated['product_heading'] ?? null;

            $biomed->banner_heading   = $validated['banner_heading'] ?? null;
            $biomed->banner_text      = $validated['banner_text'] ?? null;

            $biomed->service_heading  = $validated['service_heading'] ?? null;
            $biomed->service_sd       = $validated['service_sd'] ?? null;

            $biomed->meta_title       = $validated['meta_title'] ?? null;
            $biomed->meta_keywords    = $validated['meta_keywords'] ?? null;
            $biomed->meta_description = $validated['meta_description'] ?? null;

            // created_by / updated_by
            if (auth()->check()) {
                if ($id) {
                    $biomed->updated_by = auth()->id();
                } else {
                    $biomed->created_by = auth()->id();
                }
            }

            // -------- INTRO IMAGES (trait se) --------
            // directory: storage/app/public/biomed_services
            $biomed->intro_image_1 = $this->updateImage(
                $request,
                'intro_image_1',
                'biomed_services',
                $biomed->intro_image_1 ?? null
            );

            $biomed->intro_image_2 = $this->updateImage(
                $request,
                'intro_image_2',
                'biomed_services',
                $biomed->intro_image_2 ?? null
            );

            // -------- SERVICE CARDS (JSON) --------
            $cards = [];
            if (!empty($validated['service_cards'])) {
                foreach ($validated['service_cards'] as $card) {
                    // blank rows skip
                    if (!empty($card['heading']) || !empty($card['description'])) {
                        $cards[] = [
                            'heading'     => $card['heading'] ?? '',
                            'description' => $card['description'] ?? '',
                        ];
                    }
                }
            }
            $biomed->service_cards = $cards;

            // -------- SERVICE IMAGES (JSON + upload) --------
            $images = [];
            $inputImages = (array) $request->input('service_images', []);

            foreach ($inputImages as $index => $imgData) {
                $alt          = $imgData['alt'] ?? null;
                $existingPath = $imgData['existing_path'] ?? null;

                // nested file: service_images[index][file]
                $file = $request->file("service_images.$index.file");

                $path = $existingPath;

                if ($file instanceof \Illuminate\Http\UploadedFile) {
                    // purana file delete (agar path hai)
                    if ($existingPath) {
                        $oldPath = 'biomed_services/' . $existingPath;
                        if (Storage::disk('public')->exists($oldPath)) {
                            Storage::disk('public')->delete($oldPath);
                        }
                    }

                    // trait se naya upload
                    $path = $this->uploadImage($file, 'biomed_services');
                }

                // agar path ya alt dono me se kuch hai to hi store karo
                if ($path || $alt) {
                    $images[] = [
                        'path' => $path,
                        'alt'  => $alt,
                    ];
                }
            }

            $biomed->service_images = $images;

            // -------- SAVE & COMMIT --------
            $biomed->save();

            DB::commit();

            return redirect()
                ->back()
                ->with(
                    'success',
                    $id
                        ? 'Biomed services page updated successfully.'
                        : 'Biomed services page created successfully.'
                );
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Error saving Biomed services page', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()
                ->withInput()
                ->withErrors([
                    'general' => 'Something went wrong while saving the page. Please try again.',
                ]);
        }
    }


    public function mainPage()
    {
        $data = BiomedServices::first();
        $faqs = getFaqs('service');

        return view('frontend.pages.services', compact('data', 'faqs'));
    }
}
