<?php

namespace App\Http\Controllers;

use App\DataTables\ImportantLinksDataTable;
use App\Models\ImportantLinks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImportantLinksController extends Controller
{
    /**
     * List Important Links
     */
    public function list(ImportantLinksDataTable $dataTable)
    {
        try {
            return $dataTable->render('pages.importent-links.index');
        } catch (\Throwable $e) {
            Log::error('Important Links List Load Failed', [
                'error_message' => $e->getMessage(),
                'file'          => $e->getFile(),
                'line'          => $e->getLine(),
                'user_id'       => Auth::id(),
            ]);

            return redirect()
                ->back()
                ->withErrors(['error' => 'Unable to load Important Links. Please try again later.']);
        }
    }

    /**
     * Show create form
     */
    public function create()
    {
        try {
            return view('pages.importent-links.create');
        } catch (\Throwable $e) {
            Log::error('Important Link Create View Load Failed', [
                'error_message' => $e->getMessage(),
                'file'          => $e->getFile(),
                'line'          => $e->getLine(),
                'user_id'       => Auth::id(),
            ]);

            return redirect()
                ->back()
                ->withErrors(['error' => 'Unable to load create form. Please try again later.']);
        }
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        try {
            $data = ImportantLinks::findOrFail($id);
            return view('pages.importent-links.create', compact('data'));
        } catch (\Throwable $e) {
            Log::error('Important Link Edit View Load Failed', [
                'error_message' => $e->getMessage(),
                'file'          => $e->getFile(),
                'line'          => $e->getLine(),
                'user_id'       => Auth::id(),
                'link_id'       => $id,
            ]);

            return redirect()
                ->back()
                ->withErrors(['error' => 'Unable to load edit form. Please try again later.']);
        }
    }

    /**
     * Optional: separate methods for store and update routes
     */
    public function store(Request $request)
    {
        return $this->storeOrUpdate($request);
    }

    public function update(Request $request, $id)
    {
        return $this->storeOrUpdate($request, $id);
    }

    /**
     * Store or update
     */
    public function storeOrUpdate(Request $request, $id = null)
    {
        // Validation
        $validatedData = $request->validate([
            'for_page'    => 'required|string|in:privacy_policy,terms_conditions,disclaimer',
            'title'       => 'required|string|max:255',
            'subtitle'    => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'icon'        => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            $data = [
                'for_page'     => $validatedData['for_page'],
                'title'        => $validatedData['title'],
                'subtitle'     => $validatedData['subtitle'] ?? null,
                'button_text'  => $validatedData['button_text'] ?? null,
                'icon'         => $validatedData['icon'] ?? null,
                'updated_by'   => Auth::id(),
            ];

            if ($id) {
                // UPDATE
                $link = ImportantLinks::findOrFail($id);
                $link->update($data);
                $message = 'Important Link updated successfully.';
            } else {
                // CREATE
                $data['created_by'] = Auth::id();
                $link = ImportantLinks::create($data);
                $message = 'Important Link created successfully.';
            }

            DB::commit();

            return redirect()
                ->route('admin.importent-links.list')
                ->with('success', $message);
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Important Link store/update failed', [
                'error_message' => $e->getMessage(),
                'file'          => $e->getFile(),
                'line'          => $e->getLine(),
                'user_id'       => Auth::id(),
                'request_data'  => $request->except(['_token']),
                'link_id'       => $id,
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Something went wrong. Please try again.']);
        }
    }

    /**
     * Destroy Important Link
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $link = ImportantLinks::findOrFail($id);
            $link->delete();

            DB::commit();

            return redirect()
                ->route('admin.importent-links.list')
                ->with('success', 'Link deleted successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Important Link Destroy Failed', [
                'error_message' => $e->getMessage(),
                'file'          => $e->getFile(),
                'line'          => $e->getLine(),
                'user_id'       => Auth::id(),
                'link_id'       => $id,
            ]);

            return redirect()
                ->back()
                ->withErrors(['error' => 'Something went wrong while deleting the link.']);
        }
    }
}
