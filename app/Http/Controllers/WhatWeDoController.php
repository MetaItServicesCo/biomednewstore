<?php

namespace App\Http\Controllers;

use App\DataTables\WhatWeDoDataTable;
use App\Models\WhatWeDo;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class WhatWeDoController extends Controller
{
    use UploadImageTrait;

    public function list(WhatWeDoDataTable $dataTable)
    {
        try {
            // Render the DataTable view
            return $dataTable->render('pages.what-we-do.list');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('About Us Cards list error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            // Redirect back with a general error message
            return redirect()->back()->withErrors([
                'general_error' => 'Something went wrong while loading the cards list. Please try again.'
            ]);
        }
    }

    public function create()
    {
        return view('pages.what-we-do.create');
    }

    /**
     * Create & Update in same function
     */
    public function storeOrUpdate(Request $request, $id = null)
    {
        DB::beginTransaction();

        try {

            // Validation rules
            $rules = [
                'sections.*.title' => 'required|string|max:255',
                'sections.*.slug' => 'required|string|max:255',
                'sections.*.description' => 'nullable|string',
                'bg_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:300',
                'bg_image_alt' => 'nullable|string|max:255',
            ];

            $request->validate($rules);

            // If update
            if ($id) {
                $data = WhatWeDo::findOrFail($id);
                $data->updated_by = Auth::id();
            } else {
                // Create
                $data = new WhatWeDo();
                $data->created_by = Auth::id();
            }

            // Prepare JSON content from sections
            $sections = $request->input('sections', []);

            // Ensure slug is slugified
            foreach ($sections as &$section) {
                $section['slug'] = Str::slug($section['slug'] ?? '');
            }

            $data->content = json_encode($sections);

            // BG Image + Alt
            $data->bg_image_alt = $request->bg_image_alt;

            // Image Upload
            if ($request->hasFile('bg_image')) {
                $data->bg_image = $this->updateImage(
                    $request,
                    'bg_image',
                    'what-we-do',
                    $data->bg_image
                );
            }

            $data->save();

            DB::commit();

            $message = $id ? 'Updated successfully!' : 'Created successfully!';
            return redirect()->route('admin.what-we-do.list')->with('success', $message);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('What We Do Store/Update Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->withInput()->withErrors([
                'general_error' => 'Something went wrong. Please try again.'
            ]);
        }
    }

    /**
     * Store
     */
    public function store(Request $request)
    {
        return $this->storeOrUpdate($request);
    }

    /**
     * Update
     */
    public function update(Request $request, $id)
    {
        return $this->storeOrUpdate($request, $id);
    }

    /**
     * Edit Page
     */
    public function edit($id)
    {
        try {
            $data = WhatWeDo::findOrFail($id);
            // Decode JSON content for Blade
            if (!empty($data->content)) {
                $data->sections = json_decode($data->content, true);
            } else {
                $data->sections = [];
            }
            return view('pages.what-we-do.create', compact('data'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.what-we-do.list')
                ->withErrors(['general_error' => 'Record not found.']);
        } catch (\Exception $e) {

            Log::error('WhatWeDo Edit Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('admin.what-we-do.list')
                ->withErrors(['general_error' => 'Something went wrong.']);
        }
    }

    public function destroy($id)
    {
        try {
            // Find the record or fail
            $data = WhatWeDo::findOrFail($id);

            // Delete image if exists
            if ($data->bg_image && file_exists(public_path('storage/what-we-do/' . $data->bg_image))) {
                unlink(public_path('storage/what-we-do/' . $data->bg_image));
            }

            // Delete record
            $data->delete();

            return redirect()->route('admin.what-we-do.list')
                ->with('success', 'Record deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong while deleting.');
        }
    }
}
