@extends('frontend.layouts.frontend')

{{-- @section('title', 'About Us') --}}
@section('meta_title', $about->meta_title ?? 'About Us')
@section('meta_keywords', $about->meta_keywords ?? '')
@section('meta_description', $about->meta_description ?? '')

@push('frontend-styles')
    <style>
        .company-overview {
            padding: 60px 0;
        }

        /* Heading stays left — no wrapping to next column */
        .co-heading {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
            max-width: 500px;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 48px;
            /* forces heading to remain left column */
        }

        .co-heading span {
            color: #0168A4;
        }

        .co-desc {
            font-family: Arial;
            font-weight: 400;
            font-size: 20px;
            line-height: 160%;
            letter-spacing: 0%;
            color: #000000;
        }

        /* CARD */
        .co-card {
            max-width: 350px;
            width: 100%;
            height: 489px;
            background: #F0F0F0;
            border-radius: 20px;
            padding: 25px;
            backdrop-filter: blur(84px);
        }

        .co-number {
            font-size: 60px;
            font-weight: 700;
            /* margin-bottom: 8px; */
            font-family: 'Plus Jakarta Sans', sans-serif;
            line-height: 150%;
            letter-spacing: -3px;
        }

        .co-small {
            font-size: 15px;
            /* margin-bottom: 12px; */
            font-weight: 500;
            font-family: 'Plus Jakarta Sans', sans-serif;
            line-height: 150%;
            color: #5C5D5F;
        }

        /* DIVIDER (70% black, 30% gray) */
        .co-divider {
            width: 100%;
            height: 6.65px;
            background: linear-gradient(to right,
                    rgba(0, 0, 0, 0.7) 70%,
                    #D9D9D9 30%);
            margin-top: 20px;
        }

        /* IMAGES */
        .co-img {
            width: 100%;
            max-width: 215px;
            height: 232px;
            border-radius: 12px;
            object-fit: cover;
        }



        /* BUTTON */
        .co-btn {
            margin-top: 30px;
            background: #0168A4;
            color: #FFF;
            padding: 16px 32px;
            font-size: 16px;
            font-weight: 700;
            border: none;
            border-radius: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            width: 360px;
            height: 56px;
            line-height: 140%;
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin-right: 30px;
            transition: all 0.4s ease-in-out;
        }

        .co-btn:hover {
            transform: translateY(-3px);
            background: #044970;

        }



        .values-container .section-title {
            font-family: Arial, Helvetica, sans-serif;
            line-height: 48px;
            font-size: 48px;
            font-weight: 700;
            /* margin-bottom: 40px; */
            text-align: start;

        }





        .about-sub-title {
            font-size: 32px;
            font-weight: 500;
            margin-bottom: 20px;
            font-family: Inter, sans-serif;
            color: #046DA0;
            width: 100%;
            max-width: 522px;
        }

        .desc {
            font-family: Arial;
            font-weight: 400;
            font-size: 20px;
            line-height: 160%;
            letter-spacing: 0%;
            color: #000000;


        }

        /* BUTTON */
        .talk-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            align-items: center;
            background: #0168A4;
            color: #FFF;
            border-radius: 10px;
            font-size: 18px;
            border: none;
            font-weight: 500;
            cursor: pointer;
            transition: 0.3s ease;
            width: 100%;
            max-width: 198px;
            height: 43px;
            box-shadow: 0px 4px 4px #00000040;
            font-family: Inter, sans-serif;
            line-height: 100%;
            transition: all 0.5s ease-in-out;
            margin-top: 70px;
        }

        .talk-btn:hover {
            background: #01436b;
            transform: scale(1.03)
        }

        /* RIGHT IMAGE */
        .value-img {
            max-width: 428px;
            width: 100%;
            height: 419px;
            object-fit: cover;
            border-radius: 15px;
            border: 5px solid #0071A8;
            transition: all 0.5s ease-in-out;

        }

        .value-img:hover {
            transform: scale(1.03) translateY(-10px);
            transition: all 0.5s ease-in-out;
        }

        .card-box {
            max-width: 586px;
            width: 100%;
            height: 379px;
            padding: 30px;
            border: 3px solid #076FA1;
            border-radius: 30px;
            box-shadow: 0px 4px 14.5px #5BC3C4;
            background: #FFFFFF;
            margin-top: 40px;
            transition: all 0.5s ease-in-out;

            overflow-y: auto;
            /* scroll allowed */
            overflow-x: hidden;
        }

        /* Hide scrollbar - Chrome, Edge, Safari */
        .card-box::-webkit-scrollbar {
            width: 0;
            height: 0;
        }

        /* Hide scrollbar - Firefox */
        .card-box {
            scrollbar-width: none;
        }

        /* Hide scrollbar - IE / Edge legacy */
        .card-box {
            -ms-overflow-style: none;
        }


        .card-box:hover {
            transform: scale(1.03) translateY(-10px);
            transition: all 0.5s ease-in-out;
        }

        .about-card-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 15px;
            font-family: Inter, sans-serif;
            line-height: 48px;
            color: #0168A4;
            text-align: center;
        }

        .about-card-text {

            font-family: Arial;
            font-weight: 400;
            font-size: 20px;
            line-height: 160%;
            letter-spacing: 0%;
            color: #000000;
            text-align: center;
        }

        /* ======== about banner css ============ */

        .about-hero-section {
            background-image: url('/frontend/images/about/about-banner.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 166px;
            /* margin-top: 20px; */
        }

        /* =================== custom section css ================== */


        /* Background Section */
        .custom-section {
            background-size: cover;
            background-position: center;
            height: 567px;
            position: relative;
            /* padding: 30px; */
            margin-top: 50px;
        }

        /* Cards */
        .info-card {
            width: 537px;
            height: 280px;
            background: #004A6D99;
            color: #fff;
            padding: 30px;
            /* backdrop-filter: blur(3px); */
            position: absolute;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;


        }

        .info-card.card-right {
            width: 537px;
            height: 280px;
            background: #004A6D99;
            color: #fff;
            padding: 30px;
            /* backdrop-filter: blur(3px); */
            position: absolute;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;


        }

        /* Bottom Left Card */
        .card-left {
            bottom: 20px;
            left: 0px;
        }

        /* Top Right Card */
        .card-right {
            top: 20px;
            right: 0px;
        }

        .info-card h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 15px;
            font-family: Inter, sans-serif;
            line-height: 48px;
            color: #FFFFFF;
        }

        .custom-section-heading {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 15px;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 140%;
            color: #0D0D0D;
            text-align: center;
            margin-top: 40px;
        }

        .info-card p {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 15px;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 160%;
            color: #FFFFFF;
        }

        /*================== company slider ========================*/
        .about-company-img {
            width: 238px;
            height: 416px;
        }

        @media(max-width:768px) {
            .card-box {}

            .about-card-text {
                font-size: 14px;

            }

            .desc {
                font-size: 16px;
            }

            .about-sub-title {
                font-size: 22px;

            }

            .co-desc {
                font-size: 15px;

            }

            .info-card.card-right {
                width: 400px;
                height: 230px;

            }

            .info-card {
                width: 420px;
                height: 230px;
            }

            .info-card h2 {
                font-size: 22px;

            }

            .info-card p {
                font-size: 14px;

            }


        }

        @media(max-width:767px) {
            .co-heading {
                font-size: 33px !important;

            }

            .co-small {
                font-size: 12px !important;

            }

            .co-desc {
                font-size: 12px !important;
            }

            .info-card {
                width: 340px;
                height: 238px;
            }

            .info-card.card-right {
                width: 340px;
                height: 238px;
            }

            .info-card p {
                font-size: 11px;

            }

            .info-card h2 {
                font-size: 19px;
                ;
            }

            .about-hero-section {

                height: 58px;
            }
        }

        /* ---------- BUTTONS FIX ---------- */


        .about-card-img {
            display: block;
            margin: 0 auto;
            width: 100%;
            max-width: 238px;
            height: 416px;
            object-fit: contain;
            border-radius: 10px;
        }
    </style>
@endpush



@section('frontend-content')


    <section class="hero-detail-section">
        <div class="container py-5 text-center text-white">

            <h1 class="hero-title mb-3 fade-right">{!! highlightBracketText($about->hero_title ?? '', ['#000000']) !!}</h1>

            <p class="hero-description mx-auto mb-4 fade-left">
                {{ $about->hero_subtitle ?? '' }}
            </p>

            <div class="container py-5 text-center text-white">
                <div class="simple-breadcrumb-container text-start mx-auto">
                    <div class="simple-breadcrumb">

                        <a href="/" class="breadcrumb-link">Home</a>

                        <span class="breadcrumb-separator">|</span>

                        <span class="breadcrumb-active">About Us</span>
                    </div>
                </div>

            </div>

        </div>

    </section>
    <!-- BUTTON + ICON GROUP -->
    <x-service-btn />
    <section class="company-overview">
        <div class="container">
            <div class="row g-5">

                <!-- LEFT COLUMN -->
                <div class="col-lg-6 fade-left">
                    <h2 class="co-heading">{!! highlightBracketText($about->main_heading ?? '') !!}</h2>

                    <div class="co-desc">
                        {!! $about->main_description ?? '' !!}
                    </div>


                </div>

                <!-- RIGHT COLUMN -->
                <div class="col-lg-6 fade-right">
                    <div class="d-flex gap-3 justify-content-center w-100">

                        <div class="w-50">
                            <div class="co-card">
                                <h3 class="co-number">{{ $about->stats ?? '' }}</h3>

                                <p class="co-small">
                                    {{ $about->stats_description ?? '' }}
                                </p>

                                <div class="co-divider"></div>
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-3">

                            {{-- IMAGE 1 --}}
                            @if (!empty($about->image_1))
                                <img src="{{ asset('storage/about_us/' . $about->image_1) }}" class="img-fluid co-img"
                                    alt="{{ $about->image_1_alt ?? '' }}">
                            @else
                                <p>{{ $about->image_1_alt ?? '' }}</p>
                            @endif

                            {{-- IMAGE 2 --}}
                            @if (!empty($about->image_2))
                                <img src="{{ asset('storage/about_us/' . $about->image_2) }}" class="img-fluid co-img"
                                    alt="{{ $about->image_2_alt ?? '' }}">
                            @else
                                <p>{{ $about->image_2_alt ?? '' }}</p>
                            @endif

                        </div>

                    </div>


                    <!-- BUTTON -->
                    <div class="d-flex  justify-content-center w-75">
                        <button class="co-btn " id="getProposalBtn">
                            Get Proposal <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </div>

                </div>

            </div>
        </div>
    </section>
    @php
        $value = split_heading($about->value_section_heading ?? '');
    @endphp

    {{-- =========== value container =============  --}}
    <div class="values-container container">
        <h2 class="section-title">{{ $value['first_text'] ?? '' }}</h2>

        <div class="row g-4">
            <!-- LEFT COLUMN -->
            <div class="col-lg-7 col-md-6 fade-left">
                <h3 class="about-sub-title">{{ $value['second_text'] ?? '' }}</h3>

                <div class="desc">
                    {!! $about->value_section_description !!}

                </div>
                <a href="{{ route('contact-us') }}">
                    <button class="talk-btn">
                        Talk to Expert
                    </button>
                </a>
            </div>

            <!-- RIGHT COLUMN (IMAGE) -->


            <div class="col-lg-5 col-md-6 text-center fade-right">
                @if (!empty($about->value_section_image))
                    <img src="{{ asset('storage/about_us/' . $about->value_section_image) }}" class="value-img"
                        alt="{{ $about->value_section_image_alt ?? '' }}">
                @else
                    <p>{{ $about->value_section_image_alt ?? '' }}</p>
                @endif

            </div>
        </div>

        <!-- BOTTOM 2 COLUMN CARDS -->
        @if (isset($about_cards) && $about_cards->count() > 0)
            <div class="row">
                @foreach ($about_cards as $card)
                    <div class="col-lg-6 col-md-6 animate-card">
                        <div class="card-box">
                            <h3 class="about-card-title">{{ plainBracketText($card->title) ?? '' }}</h3>
                            <p class="about-card-text">
                                {{ $card->description ?? '' }}
                            </p>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Offer Slider Component --}}
    <x-offers-section />




    {{-- ===== banner slidder ======== --}}
    <x-brand-slider />



    {{-- ==== end --}}
    {{-- <section class="about-hero-section mt-3">

    </section> --}}


    {{-- ====== custom card ============= --}}
    @if (isset($what_we_do) && $what_we_do->count() > 0)
        <section>
            <div class="row">
                <h2 class="custom-section-heading">What We Do?</h2>
            </div>
            @foreach ($what_we_do as $item)
                @php
                    $top = $item->sections[1] ?? null;
                    $bottom = $item->sections[2] ?? null;
                @endphp
                <section class="custom-section"
                    style="background-image: url('{{ asset('storage/what-we-do/' . $item->bg_image) }}');">
                    <!-- Bottom Left Card -->
                    @if ($bottom)
                        <div class="info-card card-left ">
                            <h2 class="">{{ $bottom['title'] ?? '' }}</h2>
                            <p class="">{!! $bottom['description'] ?? '' !!}</p>
                        </div>
                    @endif

                    <!-- Top Right Card -->
                    @if ($top)
                        <div class="info-card card-right">
                            <h2>{{ $top['title'] ?? '' }}</h2>
                            <p>{!! $top['description'] ?? '' !!}</p>
                        </div>
                    @endif
                </section>
            @endforeach
        </section>
    @endif


    {{-- ================= Why Choose Biomed Section ================= --}}
    <x-why-choice-biomed />


    @if (isset($certificates) && $certificates->count() > 0)
        <section class="offer-section my-5">
            <div class="container">

                <!-- Heading -->
                <h2 class="text-center offer-title">Company <span>Certifications</span> </h2>
                <p class="text-center offer-desc mb-5">
                    We provide top-quality medical equipment & services to meet all your healthcare needs.
                </p>

                <!-- Slider Wrapper -->
                <div class="offer-slider-wrapper position-relative">

                    <!-- Prev Button -->
                    <button class="offer-prev"><i class="bi bi-chevron-left"></i></button>

                    <!-- Slider Container -->
                    <div class="offer-slider-container">
                        <div class="offer-slider-track">
                            @foreach ($certificates as $item)
                                <!-- CARD -->
                                <div class="offer-card">
                                    <img src="{{ asset('storage/company-certifications/' . $item->certificate) }}"
                                        class="img-fluid about-card-img certificate-click"
                                        alt="{{ $item->certificate_alt ?? '' }}" data-title="{{ $item->title }}"
                                        data-image="{{ asset('storage/company-certifications/' . $item->certificate) }}">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Next Button -->
                    <button class="offer-next"><i class="bi bi-chevron-right"></i></button>
                    {{-- pagination dot --}}
                    <div class="offer-pagination"></div>


                </div>
            </div>
        </section>
    @endif

    <!-- Preview Modal -->
    <div class="modal fade" id="certificateModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="certificateModalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center">
                    <img id="certificateModalImage" src="" class="img-fluid rounded" />
                </div>

            </div>
        </div>
    </div>




    {{-- ================= CTA Section ================= --}}
    <x-cta-section />

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
    {{-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> --}}

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


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.certificate-click').forEach(function(img) {

                img.addEventListener('click', function() {

                    // Set title
                    document.getElementById('certificateModalTitle').innerText = this.dataset.title;

                    // Set image
                    document.getElementById('certificateModalImage').src = this.dataset.image;

                    // Show modal
                    let modal = new bootstrap.Modal(document.getElementById('certificateModal'));
                    modal.show();
                });

            });
        });
    </script>
@endpush
