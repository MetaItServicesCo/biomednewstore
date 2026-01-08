<?php

namespace App\Http\Controllers;

use App\Models\TermsAndConditions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TermsAndConditionsController extends Controller
{
    // Frontend / Landing page
    public function index()
    {
        try {

            $data = TermsAndConditions::first();
            return view('pages.terms-conditions.index', compact('data'));
        } catch (\Throwable $e) {

            // Log the error
            Log::error('Terms & Conditions index load failed', [
                'error_message' => $e->getMessage(),
                'file'          => $e->getFile(),
                'line'          => $e->getLine(),
            ]);

            // Graceful fallback - redirect back with error
            return redirect()
                ->back()
                ->withErrors([
                    'error' => 'Unable to load Terms & Conditions at the moment. Please try again later.',
                ]);
        }
    }

    // Store or Update Terms & Conditions
    public function storeOrUpdate(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'id'                => 'nullable|exists:terms_and_conditions,id',
            'hero_title'        => 'required|string|max:255',
            'hero_subtitle'     => 'nullable|string',
            'content'           => 'nullable|string',
            'meta_title'        => 'nullable|string|max:255',
            'meta_keywords'     => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            // Common data for both create & update
            $data = [
                'hero_title'       => $validatedData['hero_title'],
                'hero_subtitle'    => $validatedData['hero_subtitle'] ?? null,
                'content'          => $validatedData['content'] ?? null,
                'meta_title'       => $validatedData['meta_title'] ?? null,
                'meta_keywords'    => $validatedData['meta_keywords'] ?? null,
                'meta_description' => $validatedData['meta_description'] ?? null,
                'updated_by'       => Auth::id(),
            ];

            if (!empty($validatedData['id'])) {
                // UPDATE
                $terms = TermsAndConditions::findOrFail($validatedData['id']);
                $terms->update($data);
            } else {
                // CREATE
                $data['created_by'] = Auth::id();
                $terms = TermsAndConditions::create($data);
            }

            DB::commit();

            return redirect()
                ->back()
                ->with(
                    'success',
                    !empty($validatedData['id'])
                        ? 'Terms & Conditions updated successfully.'
                        : 'Terms & Conditions created successfully.'
                );
        } catch (\Throwable $e) {

            DB::rollBack();

            // Log the error
            Log::error('Terms & Conditions store/update failed', [
                'error_message' => $e->getMessage(),
                'file'          => $e->getFile(),
                'line'          => $e->getLine(),
                'user_id'       => Auth::id(),
                'request_data'  => $request->except(['_token']),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'error' => 'Something went wrong. Please try again.',
                ]);
        }
    }

    public function landingPage()
    {
        try {

            $data = TermsAndConditions::first();
            return view('frontend.pages.termspage', compact('data'));
        } catch (\Throwable $e) {

            // Log the error
            Log::error('Terms & Conditions frontend landing load failed', [
                'error_message' => $e->getMessage(),
                'file'          => $e->getFile(),
                'line'          => $e->getLine(),
            ]);

            // Graceful fallback for frontend
            return redirect()
                ->back()
                ->withErrors([
                    'error' => 'Terms & Conditions is temporarily unavailable. Please try again later.',
                ]);
        }
    }
}
