<?php

namespace App\Http\Controllers;

use App\DataTables\TestimonialDataTable;
use App\Models\Testimonial;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    use UploadImageTrait;

    /**
     * List testimonials
     */
    public function list(TestimonialDataTable $dataTable)
    {
        try {
            return $dataTable->render('pages.testimonials.list');
        } catch (\Throwable $e) {
            Log::error('Testimonial List Error: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Unable to load testimonials.');
        }
    }

    /**
     * Show create form
     */
    public function create()
    {
        try {
            return view('pages.testimonials.create');
        } catch (\Throwable $e) {
            Log::error('Testimonial Create Page Error: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Unable to open create page.');
        }
    }

    /**
     * Show Edit form
     */
    public function edit($id)
    {
        try {
            $data = Testimonial::findOrFail($id);

            return view('pages.testimonials.create', compact('data'));
        } catch (\Throwable $e) {
            Log::error('Testimonial Edit Page Error: ' . $e->getMessage(), [
                'testimonial_id' => $id
            ]);

            return redirect()->back()
                ->with('error', 'Unable to open edit page.');
        }
    }

    /**
     * Store testimonial
     */
    public function store(Request $request)
    {
        return $this->storeOrUpdate($request);
    }

    /**
     * Update testimonial
     */
    public function update(Request $request, $id)
    {
        return $this->storeOrUpdate($request, $id);
    }

    /**
     * Store or Update testimonial (Single method)
     */
    public function storeOrUpdate(Request $request, $id = null)
    {
        // ---------------- VALIDATION ----------------
        $validated = $request->validate([
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_alt'         => 'nullable|string|max:255',
            'rating'            => 'required|integer|min:1|max:5',
            'short_description' => 'nullable|string',
            'is_active'         => 'nullable|boolean',
        ]);

        DB::beginTransaction();

        try {
            // ---------------- FIND OR CREATE ----------------
            $testimonial = $id
                ? Testimonial::findOrFail($id)
                : new Testimonial();

            // ---------------- IMAGE UPLOAD ----------------
            $directory = 'testimonials';

            $testimonial->image = $this->updateImage(
                $request,
                'image',
                $directory,
                $testimonial->image ?? null
            );

            // ---------------- DATA ASSIGNMENT ----------------
            $testimonial->image_alt = $validated['image_alt'] ?? null;
            $testimonial->rating = $validated['rating'];
            $testimonial->short_description = $validated['short_description'] ?? null;
            $testimonial->is_active = $validated['is_active'] ?? true;

            // ---------------- AUDIT FIELDS ----------------
            if ($id) {
                $testimonial->updated_by = Auth::id();
            } else {
                $testimonial->created_by = Auth::id();
            }

            $testimonial->save();

            DB::commit();

            return redirect()
                ->route('admin.testimonials.list')
                ->with(
                    'success',
                    $id
                        ? 'Testimonial updated successfully.'
                        : 'Testimonial created successfully.'
                );
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Testimonial Store/Update Error: ' . $e->getMessage(), [
                'id' => $id,
                'request' => $request->all(),
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Delete testimonial
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $testimonial = Testimonial::findOrFail($id);

            // ---------------- DELETE IMAGE ----------------
            if (!empty($testimonial->image)) {
                $imagePath = 'testimonials/' . $testimonial->image;

                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }

            // ---------------- DELETE RECORD ----------------
            $testimonial->delete();

            DB::commit();

            return redirect()
                ->route('admin.testimonials.list')
                ->with('success', 'Testimonial deleted successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Testimonial Delete Error: ' . $e->getMessage(), [
                'testimonial_id' => $id
            ]);

            return redirect()->back()
                ->with('error', 'Unable to delete testimonial.');
        }
    }
}
