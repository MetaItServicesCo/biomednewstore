<?php

namespace App\Http\Controllers;

use App\DataTables\BrandWeCarryDataTable;
use App\Models\BrandWeCarry;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BrandWeCarryController extends Controller
{
    use UploadImageTrait;

    public function list(BrandWeCarryDataTable $dataTable)
    {
        try {
            // Render the DataTable view
            return $dataTable->render('pages.brand-we-carry.list');
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
        return view('pages.brand-we-carry.create');
    }


    /**
     * Store or update Brand
     */
    public function storeOrUpdate(Request $request, $id = null)
    {
        DB::beginTransaction();

        try {
            // Validation
            $request->validate([
                'company_name' => 'required|string|max:255',
                'website' => 'nullable|url|max:255',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:300', // 5MB
                'logo_alt' => 'nullable|string|max:255',
            ]);

            if ($id) {
                // Update
                $brand = BrandWeCarry::findOrFail($id);
                $brand->updated_by = Auth::id();
            } else {
                // Create
                $brand = new BrandWeCarry();
                $brand->created_by = Auth::id();
            }

            // Fill fields
            $brand->company_name = $request->company_name;
            $brand->website = $request->website;
            $brand->logo = $this->updateImage($request, 'logo', 'brands-we-carry', $brand->logo ?? null);
            $brand->logo_alt = $request->logo_alt;

            $brand->save();

            DB::commit();

            $message = $id ? 'Brand updated successfully.' : 'Brand created successfully.';
            return redirect()->route('admin.brand-we-carry.list')->with('success', $message);
        } catch (\Illuminate\Validation\ValidationException $ve) {
            DB::rollBack();
            return redirect()->back()->withErrors($ve->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('BrandWeCarry store/update error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->withInput()->withErrors([
                'general_error' => 'Something went wrong! Please try again.',
            ]);
        }
    }

    /**
     * Store route
     */
    public function store(Request $request)
    {
        return $this->storeOrUpdate($request);
    }

    public function edit($id)
    {
        try {
            // Fetch brand
            $data = BrandWeCarry::findOrFail($id);

            // Return page with data (same page used for create & update)
            return view('pages.brand-we-carry.create', compact('data'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            // If brand not found
            return redirect()->route('admin.brand-we-carry.list')
                ->withErrors(['general_error' => 'Brand not found.']);
        } catch (\Exception $e) {

            // Log the error
            Log::error('BrandWeCarry edit error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            // Redirect with error
            return redirect()->route('admin.brand-we-carry.list')
                ->withErrors(['general_error' => 'Something went wrong! Please try again.']);
        }
    }



    /**
     * Update route
     */
    public function update(Request $request, $id)
    {
        return $this->storeOrUpdate($request, $id);
    }

    /**
     * Optional: Delete Brand
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $brand = BrandWeCarry::findOrFail($id);

            // Delete logo if exists
            if ($brand->logo && Storage::disk('public')->exists('brands-we-carry/' . $brand->logo)) {
                Storage::disk('public')->delete('brands-we-carry/' . $brand->logo);
            }

            $brand->delete();

            DB::commit();

            return redirect()->route('admin.brand-we-carry.list')->with('success', 'Brand deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('BrandWeCarry delete error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->withErrors([
                'general_error' => 'Something went wrong! Could not delete brand.',
            ]);
        }
    }
}
