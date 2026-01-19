<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\BiomedServicesController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LocationPageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RepairServiceController;
use App\Http\Controllers\ReviewsController;
use Illuminate\Support\Facades\Route;

// ===========================
// Store Route
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

// Route::get('/medical-equipment-repair', [RepairServiceController::class, 'landingPage'])->name('repair');
// Route::get('/{category}/{slug}', [RepairServiceController::class, 'repairServiceDetail'])->name('repair.service.detail');

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

    // Get states by country route
    Route::get('/get-states/{country_id}', [LandingPageController::class, 'getStates'])->name('get.states');

    // Get cities route
    Route::get('/get-cities/{state_id}', [LandingPageController::class, 'getCities'])->name('get.cities');

    // Blog filter route
    Route::get('/blogs/filter', [BlogController::class, 'filterBlogs'])->name('blogs.filter');

    Route::get('/best-products/filter', [LandingPageController::class, 'filter'])->name('best.products.filter');

    Route::get('/latest-products/filter', [LandingPageController::class, 'latestProductsfilter'])->name('latest.products.filter');

    // Reviews filter route
    Route::get('/feedbacks/filter', [ReviewsController::class, 'filterReviews'])->name('reviews.filter');

    Route::post('/products/filter', [ProductController::class, 'productsFilter'])->name('products.filter');
    Route::get('/parts/filter', [ProductController::class, 'partsAjax'])->name('parts.filter');
});


Route::get('/products', [ProductController::class, 'products'])->name('products');
Route::get('/product/{slug}', [ProductController::class, 'productDetail'])->name('product-detail');
Route::post('/cart/add', [ProductController::class, 'addToCart'])->name('cart.add');

Route::get('/cart', [ProductController::class, 'cart'])->name('cart');
Route::post('/cart/clear', [ProductController::class, 'clearCart'])->name('cart.clear');
Route::post('/cart/remove', [ProductController::class, 'removeCartItem'])->name('cart.remove');
Route::post('/cart/update-qty', [ProductController::class, 'updateCartQuantity'])->name('cart.update-qty');
Route::post('/product/feedback', [ProductController::class, 'productFeedback'])->name('post.product.feedback');



Route::get('/order', [ProductController::class, 'order'])->name('billing');


Route::get('/parts', [ProductController::class, 'parts'])->name('parts');
Route::get('/part/{slug}', [ProductController::class, 'partDetail'])->name('part-detail');


// ===========================
// Order Routes
// ===========================
Route::post('/order/save', [OrderController::class, 'saveOrder'])->name('order.save');
Route::post('/order/payment-intent', [OrderController::class, 'createPaymentIntent'])->name('order.payment-intent');
Route::post('/order/confirm-payment', [OrderController::class, 'confirmPayment'])->name('order.confirm-payment');
Route::get('/order/{orderId}', [OrderController::class, 'getOrder'])->name('order.details');
