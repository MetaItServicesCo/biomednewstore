@extends('frontend.layouts.frontend')

{{-- @section('title', 'Location Page') --}}
@section('meta_title', $data->meta_title ?? 'Location')
@section('meta_keywords', $data->meta_keywords ?? '')
@section('meta_description', $data->meta_description ?? '')

@push('frontend-styles')
    <style>
        .areas-section {
            padding: 70px 0;
            background: #ffffff;
            /* Light clean background */
        }

        .areas-section .areas-title {
            font-size: 48px;
            font-weight: 700;
            color: #000000;
            margin-bottom: 18px;
            font-family: Arial;
            line-height: 100%;

        }

        .areas-section .areas-title span {
            color: #066EA1;
        }

        .areas-desc {
            font-size: 16px;
            color: #00000080;
            max-width: 831px;
            margin: 0 auto;
            font-family: Arial;
            line-height: 160%;
            font-weight: 700;

        }

        /* main cities section */

        /* Full-width heading bar */
        .cities-heading-bar {
            background: #066EA1;
            text-align: center;
            width: 100%;
            height: 93px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .cities-heading {
            color: #ffffff;
            font-size: 48px;
            font-weight: 700;
            font-family: Arial;
            line-height: 100%;
            margin: 0;
        }

        /* Image styling */
        .city-img {
            width: 256px;
            height: 214px;
            object-fit: cover;
            border: 2px solid #066EA1;
            border-radius: 6px;
            box-shadow: 0px 0px 20px #026B9F;
        }

        /* Title styling */
        .city-title {
            font-size: 25px;
            font-weight: 700;
            color: #026B9F;
            text-align: start;
            padding-left: 78px;
            font-family: Arial, ;
            line-height: 100%;
        }


        /*======================= form section css =======================*/
        @media (max-width: 768px) {
            .city-title {
                margin-left: -43px;
            }
        }

        /* Mobile Responsive Fix */
        @media (max-width: 767px) {

            .contact-section .row {
                display: block !important;
            }

            .city-title {
                margin-left: -17px !important;
            }


            .col-lg-6 {
                width: 100% !important;
                max-width: 100% !important;
                margin-bottom: 20px;
            }

            .form-wrapper {
                max-width: 100% !important;
                width: 100% !important;
                height: auto !important;
            }

            .d-flex.gap-3 {
                flex-direction: column !important;
                gap: 12px !important;
            }

            /* All form elements full width */
            .formm-input,
            .formm-select,
            .formmm-select,
            .formm-text,
            .submit-btn {
                max-width: 100% !important;
                width: 100% !important;
            }

            .faqs-section {
                margin-top: 166% !important;
            }

            .areas-section .areas-title {
                font-size: 37px !important;

            }

            .cities-heading {
                color: #ffffff;
                font-size: 40px !important;

            }

            .form-heading {
                font-size: 23px !important;

            }

        }

        .latest-products-wrapper {
            margin-top: 10px;
        }

        @media (max-width: 767px) {
            .latest-products-wrapper {
                margin-top: 850px;
            }
        }


        /* @media(max-width:767px) {} */
    </style>
@endpush

@section('frontend-content')
    <section class="hero-detail-section">
        <div class="container py-5 text-center text-white">

            <h1 class="hero-title mb-3 fade-right">{!! highlightBracketText($data->hero_title ?? '', ['#000000']) !!}</h1>
            <p class="hero-description mx-auto mb-4 fade-left">
                {{ $data->hero_subtitle ?? '' }}
            </p>

            <div class="container py-5 text-center text-white">
                <div class="simple-breadcrumb-container text-start mx-auto">
                    <div class="simple-breadcrumb">

                        <a href="{{ route('home') }}" class="breadcrumb-link">Home</a>

                        <span class="breadcrumb-separator">|</span>

                        <span class="breadcrumb-active">Location</span>
                    </div>
                </div>

            </div>

        </div>
    </section>
    {{-- ============ areas section ================ --}}
    <section class="areas-section">
        <div class="container text-center">

            <h2 class="areas-title">{!! highlightBracketText($data->areas_title ?? '') !!}</h2>

            <p class="areas-desc">
                {{ $data->areas_description ?? '' }}
            </p>

        </div>
    </section>

    <!-- BUTTON + ICON GROUP -->
    <x-service-btn />

    {{-- ============ city section ==================== --}}
    <section class="major-cities-section">

        <!-- Full Width Heading -->
        <div class="cities-heading-bar">
            <h2 class="cities-heading">{{ $data->cities_section_title ?? '' }}</h2>
        </div>

        <div class="container py-5">
            <div class="row justify-content-center">
                <!-- Column -->
                @foreach ($servingCities as $servingCity)
                    <div class="col-lg-4 col-md-6 text-center mb-4 animate-card">
                        <a href="{{ route('location.detail', $servingCity->slug) }}">
                            <img src="{{ $servingCity->city_image ? asset('storage/cities/' . $servingCity->city_image) : '' }}"
                                class="city-img" alt="{{ $servingCity->city_image_alt ?? '' }}">
                            <h4 class="city-title mt-3">{{ $servingCity->area_name ?? '' }}</h4>
                        </a>
                    </div>
                @endforeach

                {{-- <!-- Column 2 -->
                <div class="col-lg-4 col-md-6 text-center mb-4 animate-card">
                    <img src="{{ asset('frontend/images/location/5.png') }}" class="city-img" alt="City 3">
                    <h4 class="city-title mt-3">Houston, TX</h4>
                </div>

                <!-- Column 3 -->
                <div class="col-lg-4 col-md-6 text-center mb-4 animate-card">
                    <img src="{{ asset('frontend/images/location/4.png') }}" class="city-img" alt="City 3">
                    <h4 class="city-title mt-3">Austin, TX</h4>
                </div>

                <div class="col-lg-4 col-md-6 text-center mb-4 animate-card">
                    <img src="{{ asset('frontend/images/location/3.png') }}" class="city-img" alt="City 3">
                    <h4 class="city-title mt-3">Dallas, TX</h4>
                </div>

                <!-- Column 2 -->
                <div class="col-lg-4 col-md-6 text-center mb-4 animate-card">
                    <img src="{{ asset('frontend/images/location/2.png') }}" class="city-img" alt="City 3">
                    <h4 class="city-title mt-3">Houston, TX</h4>
                </div>

                <!-- Column 3 -->
                <div class="col-lg-4 col-md-6 text-center mb-4 animate-card">
                    <img src="{{ asset('frontend/images/location/1.png') }}" class="city-img" alt="City 3">
                    <h4 class="city-title mt-3">Austin, TX</h4>
                </div> --}}

            </div>
        </div>

    </section>

    <section class="austin">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12  mx-auto">
                    <h2 class="austin-heading">
                        {!! highlightBracketText($data->serve_heading ?? '') !!}
                    </h2>
                    <div class="austin-desc">
                        {!! $data->serve_description ?? '' !!}

                    </div>
                    {{-- <p class="austin-desc">
                        nec Praesent libero, placerat nec non dignissim, viverra Lorem tempor vitae elit. viverra turpis
                        faucibus non. sit fringilla risus Nam ex nisl. fringilla Donec sit nisi nec Quisque Vestibulum
                        maximus Nunc ex non. volutpat vitae at, tempor</p>

                    <p class="austin-desc"> ac amet, viverra tincidunt facilisis Sed orci luctus Nam odio tincidunt urna.
                        tincidunt
                        sollicitudin. vel at orci elit tincidunt varius Donec orci dui in at, sapien orci tincidunt Morbi
                        eget eu non. facilisis odio luctus Nullam Morbi non</p>
                    <p class="austin-desc">
                        faucibus viverra ipsum viverra facilisis ex ipsum sapien elit porta ex faucibus odio orci diam
                        Quisque turpis felis, placerat viverra Donec sollicitudin. facilisis elit vitae maximus non urna
                        varius amet, eget quis ipsum eu enim. sit elit
                        Nunc lacus, urna. faucibus vitae lacus dui. dui. eget lacus In faucibus non lobortis, odio sit
                        efficitur. malesuada ex vitae eu placerat. faucibus quam massa sodales. viverra lobortis,
                    </p> --}}


                </div>
            </div>
        </div>
    </section>
    {{-- ============= form section  ===================== --}}
    {{-- <section class="contact-section py-5">
        <div class="container">
            <div class="row g-2">

                <!-- Left Column -->
                <div class="col-lg-6 animate-card">
                    <h2 class="contact-heading mb-3">Contact Us</h2>
                    <p class="contact-desc mb-4">
                        {{ $data->contact_us_description ?? '' }}
                    </p>

                    <div class="contact-info mb-3">
                        <i class="bi bi-telephone-fill contact-icon"></i>
                        <a href="tel:{{ cleanPhone(setting('phone')) }}" class="contact-text">
                            {{ setting('phone') }}
                        </a>
                    </div>

                    <div class="contact-info mb-3">
                        <i class="bi bi-envelope-fill contact-icon"></i>
                        <a href="mailto:{{ setting('email') }}" class="contact-text">
                            {{ setting('email') }}
                        </a>
                    </div>

                    <div class="contact-info mb-4">
                        <i class="bi bi-geo-alt-fill contact-icon"></i>
                        <span class="contact-text">{{ setting('address') }}</span>
                    </div>

                    <h5 class="tech-heading mb-3">Technicians dispatched from throughout Texas</h5>

                    <div class="contact-info">
                        <i class="bi bi-people-fill contact-icon"></i>
                        <span class="contact-textt">Technicians dispatched from throughout Texas</span>
                    </div>
                </div>

                <!-- Right Column: Form -->
                <div class="col-lg-6 animate-card">
                    <div class="form-wrapper p-4">
                        <h3 class="form-heading mb-3">{{ $data->form_title ?? '' }}</h3>
                        <p class="form-desc mb-4">
                            {{ $data->form_description ?? '' }}
                        </p>

                        <form>
                            <div class="mb-3">
                                <input type="text" class="form-control formm-input" placeholder="Enter Name">
                            </div>

                            <div class="mb-3">
                                <input type="email" class="form-control formm-input" placeholder="Enter Email">
                            </div>

                            <!-- City & State in same row -->
                            <div class="d-flex gap-3">
                                <div class="mb-3">
                                    <select class="form-select formm-select" name="state" id="form_state">
                                        <option value="" selected>{{ __('Select State') }}</option>
                                        @foreach ($footerStates ?? [] as $state)
                                            <option value="{{ $state->id }}">
                                                {{ $state->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <select class="form-select formm-select" id="form_city" name="city">
                                        <option>Select City</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <select class="form-select formmm-select">
                                    <option selected>Select Services</option>
                                    <option>X-Ray Machine Repair</option>
                                    <option>Imaging Maintenance</option>
                                    <option>Biomedical Services</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <textarea class="form-control formm-text" rows="4" placeholder="Enter Message"></textarea>
                            </div>

                            <button type="submit" class="btn submit-btn ">Request Submit</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section> --}}

    <x-contact-us-section :footer-states="$footerStates" />


    {{-- ================faqs section ================ --}}
    <x-faq-section :faqs="$faqs" heading="Frequently Asked Questions" subheading="" subtext=""
        image="frontend/images/hero-main-img.png" :visible="4" />



    {{-- ================= pruduct sectiion ============= --}}

    <div class="latest-products-wrapper">
        <x-our-latest-products />
    </div>

    {{-- ============= reveiw sectiion ================== --}}
    <x-testimonial-slider />

    {{-- ============ Recent News Section ============ --}}
    <!-- Default: 4 blogs -->
    <x-recent-blogs-section />
@endsection

@push('frontend-scripts')
@endpush
