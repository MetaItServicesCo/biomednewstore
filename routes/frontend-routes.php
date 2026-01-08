<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\BiomedServicesController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DisclaimerController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LocationPageController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\RentalServiceController;
use App\Http\Controllers\RepairServiceController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\TermsAndConditionsController;
use Illuminate\Support\Facades\Route;

// ===========================
// Website Route
// ===========================

Route::get('/', [LandingPageController::class, 'landingPage'])->name('home');
Route::get('/BioMed-Service', [BiomedServicesController::class, 'mainPage'])->name('biomed-services');

Route::get('/about', [AboutUsController::class, 'landingPage'])->name('about-us');

Route::get('/locations', [LocationPageController::class, 'landingPage'])->name('location');
Route::get('/locations/{slug}', [LocationPageController::class, 'locationDetail'])->name('location.detail');
Route::get('/contact', [ContactUsController::class, 'landingPage'])->name('contact-us');


Route::get('/feedback', [ReviewsController::class, 'landingPage'])->name('feedback');
Route::post('/feedback', [ReviewsController::class, 'store'])->name('post.feedback');


// web.php
Route::get('/rentals/filter', [AjaxController::class, 'filterRentalProducts'])->name('rentals.filter');

Route::get('/medical-equipment-repair', [RepairServiceController::class, 'landingPage'])->name('repair');
Route::get('/{category}/{slug}', [RepairServiceController::class, 'repairServiceDetail'])->name('repair.service.detail');

// ===========================
// Inquiry Form
// ===========================
Route::controller(InquiryController::class)->group(function () {
    Route::post('/contact-us', 'contactUsForm')->name('contact.us.form');
    Route::post('/service-request', 'serviceRequest')->name('service.request.submit');
    Route::post('/consultancy', 'consultancyForm')->name('consultancy.submit');
    Route::post('/buy-product', 'buyProductForm')->name('buy.product.submit');
    Route::post('/quote-submit', 'getAQuote')->name('get-a-quote.submit');
});

Route::prefix('ajax')->group(function () {

    // Get cities route
    Route::get('/get-cities/{state_id}', [LandingPageController::class, 'getCities'])->name('get.cities');

    // Blog filter route
    Route::get('/blogs/filter', [BlogController::class, 'filterBlogs'])->name('blogs.filter');

    Route::get('/best-products/filter', [LandingPageController::class, 'filter'])->name('best.products.filter');

    Route::get('/latest-products/filter', [LandingPageController::class, 'latestProductsfilter'])->name('latest.products.filter');

    // Reviews filter route
    Route::get('/feedbacks/filter', [ReviewsController::class, 'filterReviews'])->name('reviews.filter');
});




// ===========================
// Store Route
// ===========================

Route::get('/store', [LandingPageController::class, 'storeLandingPage'])->name('store');
