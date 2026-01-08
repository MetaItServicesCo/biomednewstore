<?php

namespace App\Http\Controllers;

use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        try {

            $data = PrivacyPolicy::first();
            return view('pages.privacy-policy.index', compact('data'));

        } catch (\Throwable $e) {

            // Log the error
            Log::error('Privacy Policy index load failed', [
                'error_message' => $e->getMessage(),
                'file'          => $e->getFile(),
                'line'          => $e->getLine(),
            ]);

            // Graceful fallback
            return redirect()
                ->back()
                ->withErrors([
                    'error' => 'Unable to load Privacy Policy at the moment. Please try again later.',
                ]);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'id'                => 'nullable|exists:privacy_policies,id',
            'hero_title'        => 'required|string',
            'hero_subtitle'     => 'nullable|string',
            'content'           => 'nullable|string',
            'meta_title'        => 'nullable|string|max:255',
            'meta_keywords'     => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            // Data common for both create & update
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
                $privacyPolicy = PrivacyPolicy::findOrFail($validatedData['id']);
                $privacyPolicy->update($data);
            } else {
                // CREATE
                $data['created_by'] = Auth::id();
                $privacyPolicy = PrivacyPolicy::create($data);
            }

            DB::commit();

            return redirect()
                ->back()
                ->with(
                    'success',
                    !empty($validatedData['id'])
                        ? 'Privacy Policy updated successfully.'
                        : 'Privacy Policy created successfully.'
                );
        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('Privacy Policy store/update failed', [
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

            $data = PrivacyPolicy::first();
            return view('frontend.pages.privacypolicy', compact('data'));

        } catch (\Throwable $e) {

            // Log the error
            Log::error('Privacy Policy frontend landing load failed', [
                'error_message' => $e->getMessage(),
                'file'          => $e->getFile(),
                'line'          => $e->getLine(),
            ]);

            // Graceful fallback for frontend
            return redirect()
                ->back()
                ->withErrors([
                    'error' => 'Privacy Policy is temporarily unavailable. Please try again later.',
                ]);
        }
    }
}
