@extends('frontend.layouts.frontend')

{{-- @section('title', 'services') --}}
@section('meta_title', $data->meta_title ?? 'Services')
@section('meta_keywords', $data->meta_keywords ?? '')
@section('meta_description', $data->meta_description ?? '')

@push('frontend-styles')
    <style>
        /* ========================service page css ======================================== */




        .hero-circles-section .container {
            z-index: 1;
        }

        .hero-main-heading {
            font-family: Inter, sans-serif;
            font-size: 32px;
            color: #0D0D0D;
            font-weight: 600;
            line-height: 140%;
        }

        .hero-main-heading span {
            color: #0071A8;
        }

        .hero-description {
            font-size: 20px;
            font-weight: 400;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 160%;
            margin-bottom: 0px;
        }


        /* Base Styles for Large Screens (Aapki original settings) */
        .hero-image-top {
            width: 593px;
            height: 323px;
            display: block;
            border-radius: 20px !important;
            box-shadow: 0px 0px 20px #0071A8 !important;
            object-fit: cover;
            /* margin-top: 70px; */
        }

        .hero-image-bottom {
            width: 610px;
            height: 336px;
            display: block;
            border-radius: 20px !important;
            box-shadow: 0px 0px 20px #0071A8 !important;
            object-fit: cover;
            margin-top: 30px;
        }

        /* --- Responsive Adjustments --- */
        @media (max-width: 991px) {
            .hero-circles-section {
                min-height: 600px;
            }

            .hero-main-heading {
                font-size: 26px;

            }

            .hero-description {
                text-align: start;
                font-size: 15px;

            }

            /* Circles ko mobile par chota kar dein ya hide kar dein */
            .circle-one {
                width: 800px;
                height: 800px;
                top: 100px;
                left: -400px;
            }

            .circle-two {
                width: 700px;
                height: 700px;
                bottom: -350px;
                right: -350px;
            }

            .equipment-heading {
                font-size: 40px !important;

            }

            .equipment-list li {
                padding-left: 10px !important;
                font-size: 17px !important;
                margin-bottom: 10px !important;
            }

            .service-main-heading {
                font-size: 32px !important;

            }

            .main-desc {

                font-size: 15px !important;
            }

            .infoo-img {

                margin: 0 auto 60px auto !important;
            }

            .btn-contact {

                margin-top: 17px !important;
            }

            .bottom-bg {

                margin-top: 0px !important;
            }
        }

        @media (max-width: 767px) {

            /* Very small devices par circles ko hide karna behtar hai performance aur simplicity ke liye */
            .circle-one,
            .circle-two {
                display: none;
            }

            .hero-image-top {

                margin-top: 27px;
            }

            .bottom-bg {
                margin-top: -257px !important;
            }

            .contact-section {

                height: 550px !important;
            }

            .service-card h4 {
                font-size: 22px !important;

            }

            .service-card p {
                font-size: 12px !important;

            }

            .rental-heading {
                font-size: 42px !important;

            }

            .service-main-heading {
                font-size: 20px !important;
            }

            .main-desc {
                font-size: 12px !important;
            }

            .hero-detail-section .hero-title {
                font-size: 37px !important;

            }

            .hero-detail-section .hero-description {
                font-size: 14px !important;
                font-weight: 600 !important;

            }

            .equipment-heading {
                font-size: 23px !important;
                font-weight: 600;

            }

            .equipment-list li {
                padding-left: 0px !important;
                font-size: 14px !important;
                margin-bottom: 10px !important;
            }

            .yes-icon {
                color: #0168A4;
                font-size: 28px !important;

            }
        }

        .medical-equipment-section {
            z-index: 2;
        }

        .equipment-heading {
            font-size: 48px;
            font-weight: 600;
            color: #0D0D0D;
            font-family: Inter, sans-serif;
            /* max-width: 900px; */
        }

        .equipment-heading span {
            color: #0071A8;
        }

        .equipment-list {
            list-style: none;
            padding-left: 0;
        }

        .equipment-list li {
            font-size: 22px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            color: #121212B2;
            font-weight: 700;
            z-index: 2;
            font-family: Inter, sans-serif;
        }

        .yes-icon {
            color: #0168A4;
            font-size: 40px;
            margin-right: 10px;
            z-index: 2;
        }


        /* ==== biomed-section ==============*/
        .biomed-section {
            /* padding: 80px 0;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            font-family: Arial, sans-serif; */
        }

        .service-main-heading {
            font-size: 40px;
            font-weight: 700;
            font-family: Arial, Helvetica, sans-serif;

            max-width: 750px;
            margin: 0 auto;
            /* 👈 THIS IS THE KEY */
            text-align: center;
        }


        .service-main-heading span {
            color: #0071A8;
        }

        .main-desc {
            text-align: center;
            max-width: 843px;
            margin: 0 auto;
            font-size: 20px;
            line-height: 160%;
            font-family: Arial;
            font-weight: 400;
            color: #000000;
        }

        /* SERVICE CARDS */
        .service-card {
            max-width: 650px;
            width: 100%;
            height: 197px;
            background: white;
            padding: 20px;
            border-radius: 20px;
            margin-bottom: 40px;
            box-shadow: 0px 0px 20px #0071A8;
        }

        .service-card h4 {
            font-size: 32px;
            margin: 0;
            font-weight: 700;
            text-align: center;
            color: #000000;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 160%;
        }

        .service-card p {
            font-size: 16px;
            color: #121212B2;
            font-family: Arial;
            line-height: 160%;
            font-weight: 400;
            max-width: 558px;

        }

        /* RIGHT SIDE IMAGES */
        .infoo-img {
            max-width: 507px;
            width: 100%;
            height: 277px;
            object-fit: cover;
            border-radius: 20px;
            /* margin-bottom: 90px; */
            display: block;
            margin: 0 auto 152px auto;
            box-shadow: 0px 0px 20px #0071A8
        }

        /* RENTAL SECTION */
        .rental-heading {
            font-size: 48px;
            font-weight: 700;
            /* margin-bottom: 25px; */
            text-align: center;
            line-height: 140%;
            color: #0D0D0D;
            font-family: Arial, Helvetica, sans-serif;
        }

        .rental-heading span {
            color: #0071A8;
        }

        /* RENTAL CARD */
        .rental-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            /* box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.10); */
            margin-bottom: 25px;
        }

        .rental-card p {
            font-size: 20px;
            font-weight: 400;
            line-height: 160%;
            color: #121212B2;
            font-family: Arial;
            width: 100%;
            max-width: 528px;
            letter-spacing: 0;
            /* height: 79px; */
        }

        .rental-h4 {
            font-size: 40px;
            font-weight: 500;
            margin-bottom: 25px;
            /* text-align: center; */
            line-height: 140%;
            color: #0D0D0D;
            font-family: Inter;
        }

        .rental-h4 span {
            font-size: 40px;
            font-weight: 500;
            margin-bottom: 25px;
            text-align: center;
            line-height: 140%;
            color: #0071A8;
            font-family: Inter, sans-serif;
        }

        .rental-img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 12px;
            margin: 10px 0;
        }

        .btn-get {
            background: #0168A4;
            color: white;
            border: none;
            border-radius: 10px;
            margin-top: 20px;
            font-weight: 500;
            cursor: pointer;
            width: 142px;
            height: 43px;
            box-shadow: 0px 4px 4px #00000040;
            font-size: 18px;
            line-height: 100%;

            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.4s ease-in-out;
        }

        .btn-get:hover {
            background: #005173;
            transform: scale(1.02) translateY(-3px)
        }

        /* WHY LIST */
        .why-heading {
            font-size: 20px;
            font-weight: 900;
            line-height: 160%;
            font-family: Arial, Helvetica, sans-serif;
            color: #121212B2;
        }

        .why-list {
            /* margin-left: 9px; */
            /* padding-left: 9px; */
        }

        .why-list li {
            font-size: 20px;
            font-weight: 400;
            line-height: 160%;
            color: #121212B2;
            font-family: Arial, Helvetica, sans-serif;
            width: 100%;
            max-width: 528px;
            letter-spacing: 0;
            margin-bottom: 10px;

        }














        .contact-section-wrapper {
            /* position: relative; */
            /* height: 550px; */
        }

        /* .top-bg {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        width: 100%;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        height: 60px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        background: #ACD5D5;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } */
        .top-bg {
            width: 100%;
            height: 10px;
            /* shadow visible */
            background: #0071A8;
            box-shadow: 0px 6px 20px rgba(0, 113, 168, 0.5);
        }


        .bottom-bg {
            width: 100%;
            height: 10px;
            background: #0071A8;
            margin-top: 0px;
        }

        /* Main Section */
        .contact-section {
            /* padding: 60px 0; */
            background: #FFFFFF;
            /* content background */
            /* position: relative; */
            z-index: 1;
            height: 400px;
        }

        .contact-section .container {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            z-index: 2;

        }

        .contact-image img {
            width: 419px;
            height: 419px;
            object-fit: cover;
            margin-top: -70px;
            margin-left: 220px;

        }

        .contact-content {
            max-width: 600px;
            /* display: flex;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            flex-direction: column; */
            gap: 20px;
            margin-top: 70px;
            margin-left: 0px !important;
        }

        .contact-heading {
            font-family: Arial, sans-serif;
            font-size: 40px;
            font-weight: 700;
            color: #0D0D0D;
        }

        .btn-contact {
            background: #0168A4;
            color: #fff;
            font-family: 'Inter', sans-serif;
            font-size: 20px;
            line-height: 140%;
            font-weight: 500;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            box-shadow: 0px 4px 4px #00000040;
            cursor: pointer;
            width: fit-content;
            transition: all 0.3s ease;
            margin-top: 40px;
        }

        .btn-contact:hover {
            opacity: 0.9;
        }

        .access-heading {
            font-family: Arial, sans-serif;
            font-size: 40px;
            font-weight: 700;
            color: #0D0D0D;
        }

        .access-btn {
            background: #0168A4;
            color: #fff;
            font-family: 'Inter', sans-serif;
            font-size: 20px;
            line-height: 140%;
            font-weight: 500;
            border: none;
            border-radius: 8px;
            box-shadow: 0px 4px 4px #00000040;
            cursor: pointer;
            width: fit-content;
            transition: all 0.3s ease;
            margin-top: 40px;
            width: 100%;
            max-width: 300px;
            height: 50px;
            transition: all .4s ease-in-out;
        }

        .access-btn:hover {
            background: #014d78;
            transform: scale(1.02)
        }

        /* Responsive */
        @media(max-width: 991px) {
            .contact-section .container {
                flex-direction: column;
                text-align: center;
                gap: 30px;
            }

            .contact-image img {
                width: 100%;
                max-width: 419px;
                height: auto;
                margin-left: 0px;
            }

            .rental-h4 {
                font-size: 30px;
            }

            .rental-card p {
                font-size: 14px;
            }

            .rental-img {
                width: 100%;

            }
        }

        @media(max-width: 767px) {
            .rental-h4 {
                font-size: 30px !important;

            }

            .rental-card p {
                font-size: 13px !important;


            }

            .rental-img {
                width: 100% !important;

            }
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

                        <a href="/" class="breadcrumb-link">Home</a>

                        <span class="breadcrumb-separator">|</span>

                        <span class="breadcrumb-active">Mr Biomed Services</span>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- BUTTON + ICON GROUP -->
    <x-service-btn />

    <section class="hero-circles-section position-relative overflow-hidden">

        <div class="circle-one"></div>
        <div class="circle-two"></div>


        <div class="container py-5 py-md-6 position-relative z-1">
            <div class="row ">

                <div class="col-lg-6 col-md-6 fade-left">
                    <h1 class="hero-main-heading  mb-4">
                        {!! highlightBracketText($data->intro_heading ?? '') !!}
                    </h1>
                    <div class="hero-description ">
                        {!! $data->intro_text ?? '' !!}

                    </div>
                    {{-- <p class="hero-description ">

                    </p> --}}
                </div>


                <div class="col-lg-6 col-md-6 text-center fade-right">
                    <div class="image-stack d-inline-block position-relative justify-content-center">

                        <img src="{{ $data->intro_image_1 ? asset('storage/biomed_services/' . $data->intro_image_1) : '' }}"
                            alt="{{ $data->intro_image_1_alt ?? '' }}" class="img-fluid hero-image-top">

                        <img src="{{ $data->intro_image_2 ? asset('storage/biomed_services/' . $data->intro_image_2) : '' }}"
                            alt="{{ $data->intro_image_2_alt ?? '' }}" class="img-fluid hero-image-bottom">

                    </div>
                </div>


            </div>
        </div>

        <x-rental-product-list-columns />

    </section>


    <section
        style="
        background-image: url('{{ asset('frontend/images/service/home-banner.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        padding: 80px 0;
        /* height:293px; */
    ">
        <div class="container  text-white">

            <h2 style="access-heading ">
                {!! highlightBracketText($data->banner_heading ?? '') !!}
            </h2>

            <p style="font-size:17px; max-width:750px; ">
                {{ $data->banner_text ?? '' }}
            </p>

            <button class="access-btn">
                View all Accessories
            </button>

        </div>
    </section>

    <section class="biomed-section pt-4" style="background: #F7F7F7;">
        <div class="container">

            <!-- MAIN HEADING -->
            <div class="row">
                <div class="row mx-auto">
                    <h2 class="service-main-heading fade-left">
                        {!! highlightBracketText($data->service_heading ?? '') !!}
                    </h2>

                    <p class="main-desc fade-right">
                        {{ $data->service_sd ?? '' }}
                    </p>
                </div>
            </div>

            <div class="row mt-5">
                <div class="row">
                    <!-- LEFT COLUMN - CARDS -->
                    <div class="col-lg-6 col-md-12">
                        @foreach ($data->service_cards ?? [] as $card)
                            <div class="service-card fade-left">
                                <h4>{{ $card['heading'] ?? '' }}</h4>
                                <p>{{ $card['description'] ?? '' }}</p>
                            </div>
                        @endforeach
                    </div>

                    <!-- RIGHT COLUMN - IMAGES -->
                    <div class="col-lg-6 col-md-12 text-center ">
                        @foreach ($data->service_images ?? [] as $image)
                            <img src="{{ $image ? asset('storage/biomed_services/' . $image['path']) : '' }}"
                                alt="{{ $image['alt'] }}" class="img-fluid infoo-img fade-right">
                        @endforeach
                    </div>

                </div>

            </div>

        </div>
        <x-rental-equipment-products-section />
    </section>



    <section class="contact-section-wrapper">
        <!-- Top Div -->
        <div class="top-bg"></div>

        <!-- Main Section -->
        <section class="contact-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Left Image -->
                        <div class="contact-image">
                            <img src="{{ asset('frontend/images/service/region-img.png') }}" alt="Medical Equipment"
                                class="img-fluid">

                        </div>

                        <!-- Right Content -->

                    </div>
                    <div class="col-md-6 ">
                        <div class="contact-content text-cente">
                            <h2 class="contact-heading text-center">Get in Touch with Our Experts</h2>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('location') }}">
                                    <button class="btn-contact">Find your local point of contact</button>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="bottom-bg"></div>

        </section>

        <!-- Bottom Div -->
    </section>





    {{-- ================= Locations We Serve Section ================= --}}
    <x-location-we-served />


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
@endpush
