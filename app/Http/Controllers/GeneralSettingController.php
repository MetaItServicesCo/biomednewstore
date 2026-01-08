<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use App\Traits\UploadImageTrait;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GeneralSettingController extends Controller
{
    use UploadImageTrait;

    public function index()
    {
        try {
            $this->authorize('read general settings');

            return view('pages.settings.general');
        } catch (AuthorizationException $e) {
            // Custom logging (optional - bohot helpful hota hai production mein)
            Log::warning('Unauthorized access attempt to General Settings', [
                'user_id' => auth()->id(),
                'user_name' => auth()->user()?->name,
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);

            // Option 1: Custom message + redirect back
            return redirect()
                ->back()
                ->with('error', 'You do not have permission to view General Settings.');
                
        } catch (\Exception $e) {
            // Koi unexpected error (just in case)
            Log::error('Unexpected error in General Settings index', [
                'error' => $e->getMessage(),
                'user_id' => auth()->id(),
            ]);

            return redirect()
                ->back()
                ->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function update(Request $request)
    {
        // Optional: Add validation if you want
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_logo' => 'nullable|image|mimes:jpg,png,jpeg,webp,svg|max:2048',
            'favicon'   => 'nullable|image|mimes:ico,png,jpg|max:512',
            'phone'     => 'nullable|string',
            'email'     => 'nullable|email',
            'smtp_host' => 'nullable|string',
            'smtp_port' => 'nullable|numeric',
        ]);

        DB::beginTransaction();

        try {
            $userId = Auth::id(); // Current logged in admin ID

            foreach ($request->except('_token') as $key => $value) {

                // Skip empty password
                if ($key === 'smtp_password' && empty($value)) {
                    continue;
                }

                $oldSetting = GeneralSetting::where('key', $key)->first();
                $oldImageValue = $oldSetting?->value;

                // Handle Image Upload using your Trait
                if ($request->hasFile($key)) {
                    $directory = 'uploads/settings';

                    if ($key === 'site_logo') {
                        $newFilename = $this->updateImage($request, $key, $directory, $oldImageValue);
                    } elseif ($key === 'favicon') {
                        $newFilename = $this->updateImage($request, $key, $directory, $oldImageValue);
                    } else {
                        // Fallback (just in case)
                        $newFilename = $this->uploadImage($request->file($key), $directory);
                    }

                    $value = $newFilename ? $directory . '/' . $newFilename : $oldImageValue;
                }

                // Prepare data array
                $data = [
                    'value' => is_string($value) ? trim($value) : $value,
                    'type'  => $request->hasFile($key) ? 'image' : ($key === 'smtp_password' ? 'password' : 'string'),
                    'group' => $this->determineGroup($key),
                    'updated_by' => $userId,
                    'updated_at' => now(),
                ];

                // Add created_by only on first creation
                if (!$oldSetting) {
                    $data['created_by'] = $userId;
                    $data['created_at'] = now();
                }

                // Update or Create
                GeneralSetting::updateOrCreate(
                    ['key' => $key],
                    $data
                );
            }

            // Clear cache safely
            Cache::forget('app_settings');

            DB::commit();

            return back()->with('success', 'All settings have been updated successfully!');
        } catch (Exception $e) {
            DB::rollBack();

            Log::error('General Settings Update Failed', [
                'user_id' => Auth::id(),
                'error'   => $e->getMessage(),
                'trace'   => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Something went wrong! Please try again. Check logs for details.');
        }
    }

    // Helper to determine group
    private function determineGroup($key)
    {
        if (str_contains($key, 'smtp')) return 'smtp';
        if (in_array($key, ['facebook', 'instagram', 'twitter', 'linkedin'])) return 'social';
        if (in_array($key, ['site_logo', 'favicon', 'site_name'])) return 'general';
        if (in_array($key, ['phone', 'email', 'whatsapp', 'address'])) return 'contact';
        return 'general';
    }
}
