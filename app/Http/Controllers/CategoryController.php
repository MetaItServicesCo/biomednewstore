<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(CategoryDataTable $dataTable)
    {
        $this->authorize('read category');

        return $dataTable->render('pages.categories.index');
    }

    public function store(Request $request)
    {

        $this->authorize('create category');

        $validator = Validator::make($request->all(), [
            'name'   => 'required|string|max:255',
            'slug'   => 'required|string|max:255|unique:categories,slug',
            'status' => 'required|in:0,1',
            'show_on_header' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        Category::create([
            'name'       => $request->name,
            'slug'       => Str::slug($request->slug),
            'status'     => $request->status,
            'show_on_header'     => $request->show_on_header,
            'created_by' => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully'
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $this->authorize('write category');

        try {

            // ---------- Permission Check ----------
            if (!auth()->user()->hasRole('administrator')) {
                return response()->json([
                    'success' => false,
                    'message' => __('You do not have permission to perform this action.')
                ], 403);
            }

            // ---------- Validation ----------
            $validator = Validator::make($request->all(), [
                'name'   => 'required|string|max:255',
                'slug'   => 'required|string|max:255|unique:categories,slug,' . $category->id,
                'status' => 'required|in:0,1',
                'show_on_header' => 'required|in:0,1',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors(),
                ], 422);
            }

            // ---------- Update ----------
            $category->update([
                'name'       => $request->name,
                'slug'       => Str::slug($request->slug),
                'status'     => $request->status,
                'show_on_header'     => $request->show_on_header,
                'updated_by' => auth()->id(),
            ]);

            return response()->json([
                'success' => true,
                'message' => __('Category updated successfully.'),
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => __('Something went wrong while updating the category.'),
                'error'   => $e->getMessage(),
            ], 500);
        }
    }


    public function destroy(Category $category)
    {
        try {
            $this->authorize('delete category');

            // ---------- Permission Check ----------
            if (!auth()->user()->hasRole('administrator')) {
                return response()->json([
                    'success' => false,
                    'message' => __('You do not have permission to perform this action.')
                ], 403);
            }


            // ---------- Soft Delete ----------
            $category->delete();

            return response()->json([
                'success' => true,
                'message' => __('Category deleted successfully.'),
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => __('Something went wrong while deleting the category.'),
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
