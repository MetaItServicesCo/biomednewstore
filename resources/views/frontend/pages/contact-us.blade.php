@extends('frontend.layouts.frontend')

{{-- @section('title', 'Contact Us') --}}
@section('meta_title', $data->meta_title ?? 'Contact Us')
@section('meta_keywords', $data->meta_keywords ?? '')
@section('meta_description', $data->meta_description ?? '')

@push('frontend-styles')
    <style>
        .team-section {
            background: #ffffff;
        }

        /* Box Styling */
        .team-box {
            padding: 30px 20px;
        }

        /* Middle Column Borders */
        .middle-box {
            border-left: 2px solid #000000;
            border-right: 2px solid #000000;
            /* border-top: 2px solid #0071A8; */
            /* border-bottom: 2px solid #0071A8; */
        }

        /* Titles */
        .team-title {
            font-size: 28px;
            font-weight: 700;
            color: #0168A4;
            font-family: Inter;
            line-height: 100%;
            margin-bottom: 5px;
        }

        /* Sub Text */
        .team-sub {
            font-size: 28px;
            font-weight: 300;
            font-family: Inter;
            line-height: 100%;
            color: #000000;
        }

        /* Responsive Fix */
        @media(max-width: 767px) {
            .middle-box {
                border: none;
                border-top: 2px solid #0071A8;
                border-bottom: 2px solid #0071A8;
                margin: 20px 0;
                padding: 20px 0;
            }
        }


        .premium-section {
            background: #ffffff;
        }

        .premium-title {
            font-size: 28px;
            font-weight: 300;
            font-family: Inter;
            color: #0A70A2;
            line-height: 100%;
            text-align: left;
            /* Left aligned */
        }

        /* Parent column ko center control ke liye */
        .logo-box {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Logo 1 */
        .premium-logo {
            width: 230.588px;
            height: 109.309px;
            max-width: 100%;
            /* screen small ho to scale down */
            object-fit: contain;
            transition: all 0.4s ease;
        }

        /* Logo 2 */
        .premium-logo1 {
            width: 156.155px;
            height: 156.155px;
            max-width: 100%;
            object-fit: contain;
            transition: all 0.4s ease;
        }

        /* Logo 3 */
        .premium-logo2 {
            width: 520.519px;
            height: 55.522px;
            max-width: 100%;
            object-fit: contain;
            transition: all 0.4s ease;
        }

        /* Mobile responsive fix */
        @media(max-width: 576px) {

            .premium-logo,
            .premium-logo1,
            .premium-logo2 {
                /* width: 100% !important; */
                /* full width but maintain aspect fit */
                height: auto !important;
                /* proportionally adjust */
            }
        }


        /* Hover effect (optional) */
        .premium-logo:hover,
        .premium-logo1:hover,
        .premium-logo2:hover {
            transform: scale(1.08);
        }


        /* Responsive */
        @media(max-width: 768px) {
            .premium-title {
                text-align: center;
                /* Mobile center */
            }
        }

        /* =============== map ================== */
        .map-section {
            width: 100%;
            padding: 0;
        }

        .map-container {
            width: 100%;
            height: 453.2987976074219px;
            /* aap isko change kar sakte ho */
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        @media (max-width: 767px) {



            .map-section {
                margin-top: 233% !important;
            }
        }


        /* ========== brand slider ==================== */

        .brand-slider {
            padding: 30px 0;
            background: #fff;
            overflow: hidden;
            margin-top: 70px;
        }

        /* 👉 Flip container horizontally */
        .swiper {
            /* transform: scaleX(-1); */
        }

        /* 👉 Flip slides back to normal */
        .swiper-slide {
            /* transform: scaleX(-1); */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        .brand-slider img {
            width: 100%;
            height: 120px;
            /* filter: grayscale(100%); */
            /* opacity: 0.8; */
            transition: 0.3s;
        }

        .brand-slider img:hover {
            /* filter: grayscale(0); */
            opacity: 1;
            transform: scale(1.1);

        }


        /* =============== what we offer ======================= */

        .customm-card {
            width: 276px;
            height: 436px;
            border-radius: 30px;
            border: 3px solid #076FA1;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            background: #fff;
            box-sizing: border-box;
            box-shadow: 0px 4px 14.8px #5BC3C4;
        }

        .custom-card-header {
            background: #0071A8;
            padding: 18px 16px;
            border-top-left-radius: 25px;
            /* slightly less than overall radius so header fits */
            border-top-right-radius: 25px;
            flex: 0 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 67px;
            /* max-width: 270px; */
        }

        .card-heading {
            margin: 0;
            font-size: 22px;
            color: #FFFFFF;
            font-weight: 700;
            text-align: center;
            line-height: 100%;
            font-family: Inter;
        }

        .custom-card-body {
            padding: 18px 20px;
            flex: 1 1 auto;
            overflow-y: auto;
            /* if list is long, allow scroll inside card */
        }

        .service-list {
            list-style: disc;
            padding-left: 18px;
            margin: 0;
        }

        .service-list li {
            font-family: Inter;
            font-weight: 500;
            font-size: 20px;
            line-height: 100%;
            letter-spacing: 0%;
        }

        /* Small device adjustments: center cards and allow full width if needed */
        @media (max-width: 575.98px) {
            .custom-card {
                width: 100%;
                max-width: 276px;
                /* keeps card from getting too large on wide phones */
                height: auto;
                min-height: 436px;
                /* keep visual height if you prefer fixed look */
            }
        }

        /* Optional: keep consistent gap between cards when centered */
        .offer-section .row>.col-12 {
            display: flex;
            justify-content: center;
        }
    </style>
@endpush



@section('frontend-content')
    <section class="hero-detail-section">
        <div class="container py-5 text-center text-white">

            <h1 class="hero-title mb-3 fade-left">{!! highlightBracketText($data->hero_title ?? '', ['#000000']) !!}</h1>

            <p class="hero-description mx-auto mb-4 fade-right">
                {{ $data->hero_subtitle ?? '' }}
            </p>

            <div class="container py-5 text-center text-white">
                <div class="simple-breadcrumb-container text-start mx-auto">
                    <div class="simple-breadcrumb">

                        <a href="{{ route('home') }}" class="breadcrumb-link">Home</a>

                        <span class="breadcrumb-separator">|</span>

                        <span class="breadcrumb-active">Contact Us</span>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <section class="team-section py-5">
        <div class="container">
            <div class="row text-center">

                <!-- Column 1 -->
                <div class="col-md-4 team-box ">
                    <h2 class="team-title fade-left">Expert</h2>
                    <p class="team-sub fade-right">BMETs</p>
                </div>

                <!-- Column 2 (with borders left & right + top-bottom) -->
                <div class="col-md-4 team-box middle-box">
                    <h2 class="team-title fade-left">Accessible</h2>
                    <p class="team-sub fade-right">And Reliable Approach</p>
                </div>

                <!-- Column 3 -->
                <div class="col-md-4 team-box">
                    <h2 class="team-title fade-left">Sleek</h2>
                    <p class="team-sub fade-right">Execution</p>
                </div>

            </div>
        </div>
    </section>


    {{-- ===== banner slidder ======== --}}
    <x-brand-slider />

    {{-- ================= contact us section ================== --}}
    <x-contact-us-section :footer-states="$footerStates" />


    <section class="map-section ">
        <div class="map-container">
            {!! $data->map_iframe ?? '' !!}
        </div>
    </section>

    {{-- ======================== offer slider ======================== --}}
    <section class="offer-section mt-5">
        <div class="container">

            <!-- Heading -->
            <h2 class="text-center offer-title">{!! highlightBracketText($data->offer_heading ?? '') !!}</h2>
            <p class="text-center offer-desc mb-5">
                {{ $data->offer_description ?? '' }}
            </p>

            <!-- Cards row -->
            <div class="row justify-content-center g-4">
                @if (!empty($data->offers) && is_array($data->offers))
                    @foreach ($data->offers as $offer)
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3 d-flex justify-content-center animate-card">
                            <div class="customm-card">
                                <div class="custom-card-header">
                                    <h3 class="card-heading">{{ $offer['title'] ?? '' }}</h3>
                                </div>
                                <div class="custom-card-body">
                                    <ul class="service-list">
                                        @if (!empty($offer['bullets']) && is_array($offer['bullets']))
                                            @foreach ($offer['bullets'] as $bullet)
                                                <li>
                                                    @if (!empty($bullet['url']))
                                                        <a href="{{ $bullet['url'] }}" target="_blank">
                                                            {{ $bullet['text'] ?? '' }}
                                                        </a>
                                                    @else
                                                        {{ $bullet['text'] ?? '' }}
                                                    @endif
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
    </section>

    <!-- BUTTON + ICON GROUP -->
    <x-service-btn />

    {{-- ================faqs section ================ --}}
    <x-faq-section :faqs="$faqs" heading="Frequently Asked Questions" subheading="" subtext=""
        image="frontend/images/hero-main-img.png" :visible="4" />



    {{-- ================= pruduct sectiion ============= --}}
    <x-our-latest-products />


    {{-- ============= reveiw sectiion ================== --}}
    <x-testimonial-slider />

    {{-- ============ Recent News Section ============ --}}
    <!-- Default: 4 blogs -->
    <x-recent-blogs-section />



@endsection

@push('frontend-scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
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
@endpush
