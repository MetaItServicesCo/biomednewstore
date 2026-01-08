<?php

namespace App\Http\Controllers;

use App\Models\AboutCard;
use App\Models\AboutUs;
use App\Models\Blog;
use App\Models\BrandWeCarry;
use App\Models\CompanyCertification;
use App\Models\Faq;
use App\Models\Offer;
use App\Models\WhatWeDo;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AboutUsController extends Controller
{
    use  UploadImageTrait;

    public function mainPage()
    {
        $data = AboutUs::first();
        return view('pages.about-us.landing', compact('data'));
    }

    public function storeOrUpdate(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validation
            $request->validate([
                'hero_title' => 'required|string|max:255',
                'hero_subtitle' => 'nullable|string',
                'main_heading' => 'nullable|string|max:255',
                'main_description' => 'nullable|string',
                'stats' => 'nullable|string|max:255',
                'stats_description' => 'nullable|string',
                'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:300',
                'image_1_alt' => 'nullable|string|max:255',
                'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:300',
                'image_2_alt' => 'nullable|string|max:255',
                'value_section_heading' => 'nullable|string|max:255',
                'value_section_description' => 'nullable|string',
                'value_section_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:300',
                'value_section_image_alt' => 'nullable|string|max:255',
                'meta_title' => 'nullable|string|max:255',
                'meta_keywords' => 'nullable|string',
                'meta_description' => 'nullable|string',
            ]);

            // Check if update or create
            if ($request->id) {
                $aboutUs = AboutUs::findOrFail($request->id);
                $aboutUs->updated_by = Auth::id();
            } else {
                $aboutUs = new AboutUs();
                $aboutUs->created_by = Auth::id();
            }

            // Fill fields
            $aboutUs->hero_title = $request->hero_title;
            $aboutUs->hero_subtitle = $request->hero_subtitle;
            $aboutUs->main_heading = $request->main_heading;
            $aboutUs->main_description = $request->main_description;
            $aboutUs->stats = $request->stats;
            $aboutUs->stats_description = $request->stats_description;

            // Handle Images
            $aboutUs->image_1 = $this->updateImage($request, 'image_1', 'about_us', $aboutUs->image_1 ?? null);
            $aboutUs->image_1_alt = $request->image_1_alt;

            $aboutUs->image_2 = $this->updateImage($request, 'image_2', 'about_us', $aboutUs->image_2 ?? null);
            $aboutUs->image_2_alt = $request->image_2_alt;

            $aboutUs->value_section_heading = $request->value_section_heading;
            $aboutUs->value_section_description = $request->value_section_description;

            $aboutUs->value_section_image = $this->updateImage($request, 'value_section_image', 'about_us', $aboutUs->value_section_image ?? null);
            $aboutUs->value_section_image_alt = $request->value_section_image_alt;

            // SEO Fields
            $aboutUs->meta_title = $request->meta_title;
            $aboutUs->meta_keywords = $request->meta_keywords;
            $aboutUs->meta_description = $request->meta_description;

            $aboutUs->save();

            DB::commit();

            $message = $request->id ? 'About Us page updated successfully.' : 'About Us page created successfully.';
            return redirect()->back()->with('success', $message);
        } catch (\Illuminate\Validation\ValidationException $ve) {
            DB::rollBack();
            return redirect()->back()->withErrors($ve->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('AboutUs store/update error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->withInput()->withErrors([
                'general_error' => 'Something went wrong! Please try again.',
            ]);
        }
    }


    public function landingPage()
    {
        $about = AboutUs::first();
        $about_cards = AboutCard::get();
        $brands = BrandWeCarry::get();
        $what_we_do = WhatWeDo::get();
        // Decode JSON content for all rows
        foreach ($what_we_do as $item) {
            $item->sections = json_decode($item->content, true);
        }

        $certificates = CompanyCertification::get();

        $faqs = Faq::where('page_name', 'about-us')
            ->select(['question', 'answer'])
            ->latest()
            ->get();

        

        return view('frontend.pages.about', compact('about', 'about_cards', 'brands', 'what_we_do', 'certificates', 'faqs'));
    }
}
