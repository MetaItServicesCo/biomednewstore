<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContactUsController extends Controller
{
    public function index()
    {
        $data = ContactUs::first();
        return view('pages.contact_us.index', compact('data'));
    }

    public function storeOrUpdate(Request $request)
    {
        // ---------------- VALIDATION ----------------
        $validated = $request->validate([
            'id' => 'nullable|exists:contact_us,id',

            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'map_iframe' => 'nullable|string',

            'offer_heading' => 'nullable|string|max:255',
            'offer_description' => 'nullable|string',

            'offers' => 'nullable|array',
            'offers.*.title' => 'nullable|string|max:255',
            'offers.*.bullets' => 'nullable|array',
            'offers.*.bullets.*.text' => 'nullable|string|max:255',
            'offers.*.bullets.*.url' => 'nullable|url',

            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            // ---------------- PREPARE DATA ----------------
            $data = [
                'hero_title' => $request->hero_title,
                'hero_subtitle' => $request->hero_subtitle,
                'map_iframe' => $request->map_iframe,

                'offer_heading' => $request->offer_heading,
                'offer_description' => $request->offer_description,

                'offers' => $request->offers ?? [],

                'meta_title' => $request->meta_title,
                'meta_keywords' => $request->meta_keywords,
                'meta_description' => $request->meta_description,
            ];

            // ---------------- CREATE OR UPDATE ----------------
            if ($request->filled('id')) {

                // UPDATE
                $contact = ContactUs::findOrFail($request->id);
                $data['updated_by'] = Auth::id();

                $contact->update($data);

                $message = 'Contact Us updated successfully';
            } else {

                // CREATE
                $data['created_by'] = Auth::id();

                $contact = ContactUs::create($data);

                $message = 'Contact Us created successfully';
            }

            DB::commit();

            return redirect()
                ->back()
                ->with('success', $message);
        } catch (\Throwable $e) {

            DB::rollBack();

            // ---------------- LOG ERROR ----------------
            Log::error('Contact Us Store/Update Failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function landingPage()
    {
        $data = ContactUs::first();
        $faqs = getFaqs('contact-us');
        return view('frontend.pages.contact-us', compact('data', 'faqs'));
    }
}
