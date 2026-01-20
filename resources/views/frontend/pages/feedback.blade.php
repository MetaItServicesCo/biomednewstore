@extends('frontend.layouts.frontend')

{{-- @section('title', 'Feedback') --}}
@section('meta_title', $data->meta_title ?? 'Feedback')
@section('meta_keywords', $data->meta_keywords ?? '')
@section('meta_description', $data->meta_description ?? '')

@push('frontend-styles')
    <style>
        /* ================= BIOMED REVIEW SECTION ================= */
        html {
            scroll-behavior: smooth;
        }

        .biomed-review-section {
            background: #006A9E1A;
            border-bottom: 30px solid #006A9E1A;
            box-shadow: 0px 0px 20px #00000040;
            margin-top: 40px;

        }

        .review-headingg {
            font-size: 50px;
            font-family: Arial;
            font-weight: 700;
            color: #000000;
            line-height: 140%;
            text-align: start;
        }

        .review-desc p {
            font-family: Arial;
            font-weight: 400;
            color: #000000;
            line-height: 160%;
            font-size: 20px;
        }

        /* Buttons */


        /* Primary Button */

        .btn-primary-custom {
            position: relative;
            max-width: 288px;
            width: 100%;
            height: 43px;
            background: #0168A4;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            font-weight: 400;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.5s ease;

            box-shadow: 0px 0px 4px #00000040;
            clip-path: polygon(0% 0%,
                    100% 0%,
                    100% 100%,
                    0% 100%);
            border-radius: 10px;

        }

        /* ✨ hover par straight ho jaye */
        .btn-primary-custom:hover {


            clip-path: polygon(12% 0%,
                    100% 0%,
                    88% 100%,
                    0% 100%);

        }









        /* Outline Button */
        .btn-outline-custom {
            max-width: 160px;
            width: 100%;
            background: #0168A4;
            color: #fff;
            box-shadow: 0px 0px 4px #00000040;
            transition: all 0.4s ease-in-out;
            display: flex;
            justify-content: center;
            align-items: center;
            /* text vertically center */
            border-radius: 10px;
            font-weight: 400;
            text-decoration: none;
            font-size: 20px;
            height: 43px;
            line-height: 100%;

        }

        .btn-outline-custom:hover,
        .btn-primary-custom:hover {
            background: #015789;
            color: #fff;
            transform: scale(1.04)
        }


        /* Right Image */
        .review-img {
            width: 532px;
            height: 425.5999px;
            object-fit: cover;
            border-radius: 10px;
        }


        /* ================= RESPONSIVE ================= */

        @media(max-width: 992px) {
            .review-headingg {
                font-size: 28px;
            }

            .review-img {
                width: 100%;
                height: auto;
            }
        }

        @media(max-width: 576px) {
            .review-btn {
                width: 100%;
                text-align: center;
            }

            .btn-primary-custom,
            .btn-outline-custom {

                font-size: 13px !important;
                height: 38px !important;

            }
        }

        .bio-section {
            width: 100%;
        }

        /* Logo Image */
        .bio-img {
            width: 226px;
            height: 184px;
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
            object-fit: cover;
        }

        /* Blue Box */
        .bio-box {
            background: #0071A8;
            max-width: 1112px;
            height: 184px;
            padding: 25px;
            color: white;
            border-top-right-radius: 30px;
            border-bottom-right-radius: 30px;
            position: relative;
        }

        .bio-heading {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .bio-desc {
            font-size: 15px;
            line-height: 1.4;
            max-width: 90%;
        }

        /* Button */
        .bio-btn {
            position: absolute;
            right: 20px;
            bottom: 20px;
            background: #ffffff;
            color: #0071A8;
            padding: 10px 22px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0px 3px 6px #00000020;
            transition: 0.2s ease-in-out;
        }

        /* ============================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   📱 Responsive Breakpoints
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   ============================ */

        @media (max-width: 768px) {
            .bio-wrapper {
                /* text-align: center; */
            }

            .bio-img {
                /* width: 100%; */
                height: auto;
                border-radius: 20px 20px 0 0;
            }

            .bio-box {
                /* border-radius: 0 0 20px 20px; */
                height: auto;
                text-align: left;
            }

            .bio-btn {
                position: static;
                margin-top: 15px;
                display: inline-block;
            }

            .bio-heading {
                font-size: 16px;

            }

            .bio-desc {
                font-size: 10px;

            }
        }

        /* Extra Small (xs) */
        @media (max-width: 480px) {
            .bio-wrapper {
                /* text-align: center; */
            }

            .bio-img {
                width: 100%;
                height: auto;
                border-radius: 0px !important;
            }

            .bio-box {
                border-radius: 0 0 20px 20px;
                height: auto;
                text-align: left;
            }

            .bio-btn {
                position: static;
                margin-top: 15px;
                display: inline-block;
            }

            .bio-heading {
                font-size: 16px;

            }

            .bio-desc {
                font-size: 10px;

            }

            .flex-wrrapper {
                display: flex;
                flex-wrap: wrap;
            }

        }


        .bio-btn:hover {
            transform: scale(1.05);
        }


        /* Section Heading */
        .customer-heading {
            font-size: 50px;
            font-weight: 700;
            color: #000000;
            font-family: Arial;
            line-height: 120%;
        }

        .customer-heading span {
            color: #0071A8;
        }

        .customer-desc {
            font-size: 20px;
            font-weight: 400;
            max-width: 950px;
            font-family: Arial;
            line-height: 160%;
            margin: auto;
            color: #00000080;
        }

        .category-btn-wrapper {
            max-width: 1196px;
            /* same as cards row width */
            margin: 0 auto;
            /* center container */
        }

        /* Buttons */
        .cust-btn {
            /* border: 1px solid #0071A8; */
            background: transparent;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            border: none;
            max-width: 200px;
            height: 54px;
            font-size: 20px;
            font-family: Inter;
            line-height: 100%;
            color: #000000;
        }

        .active-btn {
            background: #E5F0F5;
            box-shadow: 0px 4px 4px #00000040;
            border: none;
            color: #0071A8;
            max-width: 200px;
            height: 54px;
            padding: 0px 22px;
            border-radius: 10px;


        }

        /* Review Cards */
        .review-card {
            width: 315px;
            height: 374px;
            background: #006A9E1A;
            /* border-radius: 12px; */
            padding: 20px;
            /* overflow-y: auto; */
            box-shadow: 0px 0px 20px #00000040;
        }

        .review-scroll {
            max-height: 256px;
            overflow-y: auto;
            margin: 20px 0;
            scroll-behavior: smooth;

        }

        /* .review-scroll::-webkit-scrollbar {
                                                                                                                                                                                                                                    width: 8px;
                                                                                                                                                                                                                                } */

        /* -------- Scrollbar Styling -------- */
        .review-scroll::-webkit-scrollbar {
            width: 16px;
        }

        .review-scroll::-webkit-scrollbar-thumb {
            background-color: #0071A8;
            border-radius: 6px;
        }

        .review-scroll::-webkit-scrollbar-thumb:hover {
            background-color: #005f87;
        }

        .review-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .review-scroll {
            scrollbar-color: #0071A8 transparent;
        }






        .comments-box {
            max-height: 254px;
            overflow-y: auto;
            margin: 20px 0;
        }

        /* -------- Scrollbar Styling -------- */
        .comments-box::-webkit-scrollbar {
            width: 16px;
        }

        .comments-box::-webkit-scrollbar-thumb {
            background-color: #0071A8;
            border-radius: 6px;
        }

        .comments-box::-webkit-scrollbar-thumb:hover {
            background-color: #005f87;
        }

        .comments-box::-webkit-scrollbar-track {
            background: transparent;
        }

        .comments-box {
            scrollbar-color: #0071A8 transparent;
        }








        /* Stars */
        .stars i {
            color: #FFC107;
            font-size: 20px;
            margin-right: 3px;
        }

        .end {
            color: #CACDD8 !important;
        }

        /* Text */
        .review-text {
            font-size: 20px;
            font-weight: 400;
            font-family: Arial;
            line-height: 160%;
            color: #00000080;
        }

        .client-name {
            font-size: 16px;
            font-weight: 700;
            line-height: 160%;

            margin-top: 20px;
            color: #202020;
        }

        /* Responsive Fix */
        @media (max-width: 768px) {
            .customer-heading {
                font-size: 26px;
            }

            .review-card {
                width: 100%;
                max-width: 330px;
                height: auto;
            }
        }


        .rate-box {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .rate-title {
            font-size: 24px;
            font-weight: 700;
            font-family: Inter;
            line-height: 140%;
            margin: 0;
            color: #403F3F;
        }

        .rate-stars i {
            color: #CACDD8;
            font-size: 40px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        .rate-stars .star {
            color: #ccc;
            cursor: pointer;
            font-size: 22px;
        }

        .rate-stars .star.active {
            color: #f5b301;
        }


        /* =========================== */
        /* Force Right → Left sliding */
    </style>
@endpush



@section('frontend-content')


    <section class="hero-detail-section">
        <div class="container py-5 text-center text-white">

            <h1 class="hero-title mb-3 fade-left">Real Experiences. Trusted Biomedical Store</h1>

            <p class="hero-description mx-auto mb-4 fade-right">
                Welcome to Mr. Biomed Tech Store (mbmts.com) – your one-stop online shop for biomedical equipment, parts,
                and accessories.
                Here you can explore real reviews from hospitals, clinics, labs, and technicians who buy from us.
            </p>

            <div class="container py-5 text-center text-white">
                <div class="simple-breadcrumb-container text-start mx-auto">
                    <div class="simple-breadcrumb">

                        <a href="{{ route('home') }}" class="breadcrumb-link">Home</a>

                        <span class="breadcrumb-separator">|</span>

                        <span class="breadcrumb-active">Feedback</span>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <section class="biomed-review-section py-5">
        <div class="container">
            <div class="row  g-4">

                <!-- LEFT COLUMN -->
                <div class="col-lg-6">

                    <h2 class="review-headingg mb-3 fade-right">
                        Mr. Biomed Tech Reviews <span>What It’s Like To Shop With Us</span>
                    </h2>

                    <div class="review-desc mb-4 fade-left">
                        Buying biomedical equipment online requires trust, quality, and reliability. At mbmts.com, we make
                        it easy for healthcare professionals to find genuine medical products with complete peace of mind.
                        Our customers choose us because we offer:
                        100% Genuine Biomedical Products


                        Competitive Store Pricing


                        Fast & Secure Delivery


                        Verified Medical Brands


                        Expert Pre-Sales Guidance


                        After-Sales Technical Support


                        From ICU equipment to small spare parts – we deliver quality at your doorstep.

                    </div>

                    <div class="d-flex gap-4 mt-5 ">
                        <a href="javascript:void(0)" class=" btn-primary-custom fade-left" data-open-service-modal>Request a
                            Quote Today!</a>
                        <a href="#review-cards-section" class="btn-outline-custom fade-right">Reviews</a>
                    </div>

                </div>

                <!-- RIGHT COLUMN -->
                <div class="col-lg-6 text-center fade-right">
                    <img src="{{ asset('storage/' . setting('site_logo', 'frontend/images/logo.png')) }}" class="review-img"
                        alt="{{ setting('site_name') }}">

                </div>

            </div>
        </div>
    </section>
    <section class="bio-section container my-5">
        <div class="container">
            <div class="d-flex  justify-content-center align-items-center flex-wrrapper">

                <!-- Left Image -->
                <img src="{{ asset('storage/' . setting('site_logo', 'frontend/images/logo.png')) }}"
                    alt="{{ setting('site_name') }}" class="bio-img">

                <!-- Blue Box -->
                <div class="bio-box position-relative">
                    <h3 class="bio-heading">Expert Biomedical Store for Your Equipment Needs</h3>

                    <p class="bio-desc">
                        Shop medical equipment, parts, and accessories with confidence.
                        Our team ensures you get the right product for the right application.
                    </p>

                    <!-- Button bottom-right -->
                    <a href="javascript:void(0)" class="bio-btn" id="" data-open-service-modal>Get My Free
                        Proposal</a>
                </div>

            </div>
        </div>
    </section>

    <section class="customer-section  my-5">



        <!-- Heading -->
        <h2 class="customer-heading text-center fade-left">
            Hear From 1,100+ Happy Customers
        </h2>

        <!-- Description -->
        <p class="customer-desc text-center fade-right">
            Hospitals, labs, and technicians across the country trust mbmts.com for their biomedical purchases.
        </p>

        <!-- Category Buttons -->


        <!-- Review Cards -->
        <div class="container" id="review-cards-section">

            <div class="d-flex gap-3 flex-wrap mt-4 w-100 category-btn-wrapper">
                @foreach ($categories as $category)
                    <button class="cust-btn {{ $category->id == $firstCategory->id ? 'active-btn' : '' }}"
                        data-slug="{{ $category->slug }}">
                        {{ $category->name }}
                    </button>
                @endforeach


            </div>
            <!-- Reviews Container -->
            <div class="row justify-content-center mt-5 g-4" id="reviews-container">
                @include('partials.review-cards', ['reviews' => $reviewsByCategory])
            </div>

            <!-- Pagination -->
            <div class="mt-4" id="reviews-pagination-container">
                @include('partials.review-pagination', ['reviews' => $reviewsByCategory])
            </div>

            {{-- <div class="pagination">
                <a href="#" class="page-link">&laquo;</a>
                <a href="#" class="page-link">1</a>
                <a href="#" class="page-link active">2</a>
                <a href="#" class="page-link">3</a>

                <span class="ellipsis">---</span>

                <a href="#" class="page-link">15</a>
                <a href="#" class="page-link">&raquo;</a>
            </div> --}}
        </div>
    </section>


    {{-- ===================== feedback section ======================== --}}

    <section class="comment-section py-5">
        <div class="container">
            <div class="row g-4">

                <!-- ================= LEFT COLUMN ================= -->
                <div class="col-lg-6 col-md-6 fade-lef animate-card">

                    <h3 class="comment-heading mb-4">Leave a Feedback</h3>

                    <form id="feed_back_form" action="{{ route('post.feedback') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <input type="text" name="name" class="form-control comment-input"
                                placeholder="Enter Name">
                            <span class="text-danger error-text name_error"></span>
                        </div>

                        <div class="mb-3">
                            <input type="email" name="email" class="form-control comment-input"
                                placeholder="Enter Email">
                            <span class="text-danger error-text email_error"></span>
                        </div>

                        <div class="mb-3">
                            <select name="category" class="form-select comment-input">
                                <option value="">Select Category</option>
                                @foreach ($allCategories as $slug => $name)
                                    <option value="{{ $slug }}" {{ old('category') == $slug ? 'selected' : '' }}>
                                        {{ $name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text category_error"></span>
                        </div>


                        <div class="mb-3">
                            <textarea name="message" class="form-control comment-textarea" rows="5" placeholder="Write your comment"></textarea>
                            <span class="text-danger error-text message_error"></span>
                        </div>

                        {{-- ⭐ Rating --}}
                        <div class="rate-box mb-3">
                            <h4 class="rate-title">Give The Rate!</h4>

                            <div class="rate-stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa-solid fa-star star" data-value="{{ $i }}"></i>
                                @endfor
                            </div>

                            <input type="hidden" name="rating" id="rating">
                            <span class="text-danger error-text rating_error"></span>
                        </div>

                        <div class="form-group mb-3">
                            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                            <div class="g-recaptcha w-100" data-sitekey="{{ config('services.recaptcha.sitekey') }}">
                            </div>
                            <span class="text-danger error-text g-recaptcha-response_error"></span>
                        </div>

                        <button type="submit" class="btn submitt-btn mt-4">Submit</button>
                    </form>

                </div>

                <!-- ================= RIGHT COLUMN ================= -->
                <div class="col-lg-6 col-md-6 fade-righ animate-card">

                    <h3 class="comment-heading mb-3">Feedbacks [{{ $latestReviews->count() }}]</h3>

                    <!-- Outer Box -->
                    <div class="feedback-box">

                        <!-- Inner Comment -->
                        @if ($latestReviews->isNotEmpty())
                            @foreach ($latestReviews as $review)
                                <div class="single-comment">
                                    <h5 class="comment-name">{{ $review->name }}</h5>
                                    <p class="comment-by">
                                        {{ \Illuminate\Support\Str::words($review->message, 6, '...') }}
                                    </p>
                                </div>
                            @endforeach
                        @else
                            <p>No feedbacks available.</p>
                        @endif
                    </div>

                </div>

            </div>
        </div>
    </section>



    {{-- ===== banner slidder ======== --}}
    <x-brand-slider />


    {{-- ================= pruduct sectiion ============= --}}
    <x-our-latest-products />


    {{-- ============= reveiw sectiion ================== --}}
    <x-testimonial-slider />

@endsection

@push('frontend-scripts')
    <script>
        document.querySelector('.btn-outline-custom').addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector('#review-cards-section');
            const offset = 100; // adjust if you have fixed header
            window.scrollTo({
                top: target.offsetTop - offset,
                behavior: 'smooth'
            });
        });


        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 6,
            spaceBetween: 50,
            loop: true,
            speed: 3000, // continuous smooth speed
            autoplay: {
                delay: 0, // no pause
                disableOnInteraction: false
            },
            allowTouchMove: true,

            breakpoints: {
                320: {
                    slidesPerView: 2
                },
                480: {
                    slidesPerView: 3
                },
                768: {
                    slidesPerView: 4
                },
                1024: {
                    slidesPerView: 6
                }
            }
        });

        // Hover Pause
        const swiperEl = document.querySelector(".mySwiper");
        swiperEl.addEventListener("mouseenter", () => swiper.autoplay.stop());
        swiperEl.addEventListener("mouseleave", () => swiper.autoplay.start());
    </script>

    <script>
        $(document).ready(function() {

            // ⭐ STAR CLICK LOGIC
            $('.rate-stars .star').on('click', function() {
                let rating = $(this).data('value');
                $('#rating').val(rating);

                $('.rate-stars .star').removeClass('active');
                $('.rate-stars .star').each(function() {
                    if ($(this).data('value') <= rating) {
                        $(this).addClass('active');
                    }
                });
            });

            // 🚀 AJAX SUBMIT
            $('#feed_back_form').on('submit', function(e) {
                e.preventDefault();

                let form = $(this);
                let actionUrl = form.attr('action');

                $('.error-text').text('');

                $.ajax({
                    url: actionUrl,
                    method: 'POST',
                    data: form.serialize(),
                    dataType: 'json',

                    success: function(response) {
                        if (response.success) {

                            // Reset form
                            form[0].reset();
                            $('#rating').val('');
                            $('.rate-stars .star').removeClass('active');

                            if (typeof grecaptcha !== 'undefined') {
                                grecaptcha.reset();
                            }

                            if (typeof toastr !== 'undefined') {
                                toastr.success(response.message);
                            } else {
                                alert(response.message);
                            }
                        }
                    },

                    error: function(xhr) {

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            $.each(errors, function(key, value) {
                                $('.' + key + '_error').text(value[0]);
                            });

                            if (typeof grecaptcha !== 'undefined') {
                                grecaptcha.reset();
                            }

                            if (typeof toastr !== 'undefined') {
                                toastr.error('Please fix the errors.');
                            }

                        } else {
                            if (typeof toastr !== 'undefined') {
                                toastr.error('Something went wrong. Try again.');
                            } else {
                                alert('Something went wrong.');
                            }
                        }
                    }
                });
            });

        });

        document.addEventListener('DOMContentLoaded', function() {

            const container = document.getElementById('reviews-container');
            const paginationContainer = document.getElementById('reviews-pagination-container');
            const filterUrl = "{{ route('reviews.filter') }}";
            let activeSlug = "{{ $firstCategory->slug ?? '' }}";

            // Fetch reviews via AJAX
            function fetchReviews(slug, page = 1) {
                activeSlug = slug;

                container.innerHTML = `
                    <div class="col-12 text-center py-5">
                        <div class="spinner-border text-primary"></div>
                        <p class="mt-2">Loading reviews...</p>
                    </div>
                `;

                fetch(`${filterUrl}?slug=${slug}&page=${page}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        // Replace review cards and pagination
                        container.innerHTML = data.html;
                        paginationContainer.innerHTML = data.pagination;
                    })
                    .catch(() => {
                        container.innerHTML =
                            `<div class="col-12 text-center text-danger py-5">Failed to load reviews.</div>`;
                    });
            }

            // CATEGORY CLICK
            document.querySelectorAll('.cust-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.cust-btn').forEach(i => i.classList.remove(
                        'active-btn'));
                    this.classList.add('active-btn');

                    fetchReviews(this.dataset.slug, 1); // Reset to page 1 on category change
                });
            });

            // PAGINATION CLICK (Event Delegation)
            paginationContainer.addEventListener('click', function(e) {
                const link = e.target.closest('.page-link');
                if (!link || link.classList.contains('disabled') || !link.dataset.page) return;

                e.preventDefault();
                fetchReviews(activeSlug, link.dataset.page);
            });

            // Optional: Load default first category reviews on page load
            if (activeSlug) {
                fetchReviews(activeSlug, 1);
            }

        });
    </script>
@endpush
