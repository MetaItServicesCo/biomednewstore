<?php

namespace App\Http\Controllers;

use App\DataTables\OemsDataTable;
use App\Models\OemContent;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class OemContentController extends Controller
{
    use UploadImageTrait;

    public function index(OemsDataTable $dataTable)
    {
        // $items = OemContent::orderBy('order')->get();
        return $dataTable->render('pages.oem_section.index');
    }

    public function create()
    {
        return view('pages.oem_section.create');
    }

    public function store(Request $request)
    {
        try {
            // Validate the input
            $validated = $request->validate([
                'title'             => 'required|string|max:255',
                'slug'              => 'required|string|max:255|unique:oem_contents,slug',
                'order'             => 'nullable|integer',
                'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:307', // 307 KB ~ 300KB
                'image_alt'         => 'nullable|string|max:255',
                'meta_title'        => 'nullable|string|max:255',
                'meta_keywords'     => 'nullable|string|max:255',
                'meta_description'  => 'nullable|string|max:500',
                'description'       => 'nullable|string',
            ], [
                'image.max' => 'The image size must not exceed 300 KB.',
            ]);

            DB::beginTransaction();
            // Upload image if exists
            $imageName = null;
            if ($request->hasFile('image')) {
                $imageName = $this->uploadImage($request->file('image'), 'oem_contents');
                if (!$imageName) {
                    return redirect()->back()->withInput()->withErrors(['image' => 'Failed to upload image.']);
                }
            }

            // Create new OEM content
            OemContent::create([
                'title'         => $validated['title'],
                'slug'          => Str::slug($validated['slug'] ?? ''),
                'order'         => $validated['order'] ?? null,
                'image'         => $imageName,
                'image_alt'     => $validated['image_alt'] ?? null,
                'meta_title'    => $validated['meta_title'] ?? null,
                'meta_keywords' => $validated['meta_keywords'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
                'description'       => $validated['description'] ?? null,
                'created_by'        => auth()->id(),
            ]);

            DB::commit();

            return redirect()->route('admin-oems.index')->with('success', 'OEM Content created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation errors back to the form
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            // General error handling
            return redirect()->back()->withInput()->withErrors([
                'general' => 'Something went wrong: ' . $e->getMessage()
            ]);
        }
    }

    public function edit(OemContent $oem)
    {
        return view('pages.oem_section.create', ['data' => $oem]);
    }

    public function update(Request $request, OemContent $oem)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'title'             => 'required|string|max:255',
                'slug'              => 'required|string|max:255|unique:oem_contents,slug,' . $oem->id,
                'order'             => 'nullable|integer',
                'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:307', // ~300KB
                'image_alt'         => 'nullable|string|max:255',
                'meta_title'        => 'nullable|string|max:255',
                'meta_keywords'     => 'nullable|string|max:255',
                'meta_description'  => 'nullable|string|max:500',
                'description'       => 'nullable|string',
            ], [
                'image.max' => 'The image size must not exceed 300 KB.',
            ]);

            DB::beginTransaction();

            // Update image if new file uploaded
            $imageName = $this->updateImage($request, 'image', 'oem_contents', $oem->image);

            // Update OEM content
            $oem->update([
                'title'         => $validated['title'],
                'slug'          => Str::slug($validated['slug']),
                'order'         => $validated['order'] ?? null,
                'image'         => $imageName,
                'image_alt'     => $validated['image_alt'] ?? null,
                'meta_title'    => $validated['meta_title'] ?? null,
                'meta_keywords' => $validated['meta_keywords'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
                'description' => $validated['description'] ?? null,
                'updated_by' => auth()->id(),
            ]);

            DB::commit();

            return redirect()->route('admin-oems.index')->with('success', 'OEM Content updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('OEM Content validation failed during update', [
                'errors' => $e->errors(),
                'input' => $request->all()
            ]);
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('OEM Content update failed', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all()
            ]);
            return redirect()->back()->withInput()->withErrors([
                'general' => 'Something went wrong. Please try again.'
            ]);
        }
    }

    public function destroy(OemContent $oem)
    {
        // $this->authorize('delete oem');

        DB::beginTransaction();

        try {
            $authId = Auth::id();

            // Delete Thumbnail
            if ($oem->image && Storage::disk('public')->exists('oem_contents/' . $oem->image)) {
                Storage::disk('public')->delete('oem_contents/' . $oem->image);
            }

            $oem->delete();

            DB::commit();

            return redirect()->route('admin-oems.index')->with('success', 'OEM Content deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('OEM Content Delete Error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'oem_id' => $oem->id
            ]);

            return back()->withErrors(['error' => 'Failed to delete the OEM Content: ' . $e->getMessage()]);
        }
    }
}
