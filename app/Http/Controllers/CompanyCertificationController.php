<?php

namespace App\Http\Controllers;

use App\DataTables\CompanyCertificationDataTable;
use App\Models\CompanyCertification;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CompanyCertificationController extends Controller
{
    use UploadImageTrait;

    public function list(CompanyCertificationDataTable $dataTable)
    {
        try {
            // Render the DataTable view
            return $dataTable->render('pages.certificate.list');
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
        return view('pages.certificate.create');
    }

    /**
     * Create & Update (Same Function)
     */
    public function storeOrUpdate(Request $request, $id = null)
    {
        DB::beginTransaction();

        try {

            $rules = [
                'title'            => 'required|string|max:255',
                'certificate'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:300',
                'certificate_alt'  => 'nullable|string|max:255',
            ];

            $request->validate($rules);

            // If update
            if ($id) {
                $data = CompanyCertification::findOrFail($id);
                $data->updated_by = Auth::id();
            } else {
                // Create new
                $data = new CompanyCertification();
                $data->created_by = Auth::id();
            }

            // Fill fields
            $data->title = $request->title;
            $data->certificate_alt = $request->certificate_alt;

            // Upload / Replace Image using Trait
            $data->certificate = $this->updateImage(
                $request,
                'certificate',
                'company-certifications',
                $data->certificate
            );

            // Save
            $data->save();

            DB::commit();

            $message = $id ? 'Certification updated successfully!' : 'Certification created successfully!';
            return redirect()->route('admin.company-certification.list')->with('success', $message);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Company Certification Store/Update Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->withInput()->withErrors([
                'general_error' => 'Something went wrong. Please try again.'
            ]);
        }
    }


    /**
     * Store (Call Common Function)
     */
    public function store(Request $request)
    {
        return $this->storeOrUpdate($request);
    }


    /**
     * Update (Call Common Function)
     */
    public function update(Request $request, $id)
    {
        return $this->storeOrUpdate($request, $id);
    }


    /**
     * Edit
     */
    public function edit($id)
    {
        try {

            $data = CompanyCertification::findOrFail($id);
            return view('pages.certificate.create', compact('data'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return redirect()->route('pages.certificate.list')
                ->withErrors(['general_error' => 'Record not found.']);
        } catch (\Exception $e) {

            Log::error('Company Certification Edit Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('pages.certificate.list')
                ->withErrors(['general_error' => 'Something went wrong.']);
        }
    }


    /**
     * Delete
     */
    public function destroy($id)
    {
        try {
            $data = CompanyCertification::findOrFail($id);

            // Delete certificate image from storage if it exists
            if (!empty($data->certificate)) {
                $filePath = public_path('storage/company-certifications/' . $data->certificate);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // Delete record
            $data->delete();

            return redirect()->route('admin.company-certification.list')
                ->with('success', 'Record deleted successfully.');
        } catch (\Exception $e) {

            Log::error('Company Certification Delete Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Something went wrong while deleting.');
        }
    }
}
