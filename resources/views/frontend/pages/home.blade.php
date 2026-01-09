@extends('frontend.layouts.frontend')

{{-- @section('title', 'Home') --}}
@section('meta_title', $data->meta_title ?? 'Mr. Biomed Tech Services')
@section('meta_keywords', $data->meta_keywords ?? '')
@section('meta_description', $data->meta_description ?? '')

@push('frontend-styles')
    <style>
        .image-dots .dot {
            width: 12px;
            height: 12px;
            background: #888;
            border-radius: 50%;
            display: inline-block;
            margin: 0 6px;
            cursor: pointer;
            transition: 0.3s;
        }

        .image-dots .dot.active {
            background: #006A9E;
            transform: scale(1.2);
        }

        /* ==================== hero section cs =============================*/

        /* Headings */
        .main-heading {
            font-size: 55px;
            font-weight: 900;
            font-family: Arial;
            letter-spacing: 0;
            line-height: 100%;
            color: #0168A4;
        }

        .sub-heading {
            font-size: 50px;
            font-weight: 900;
            font-family: Arial;
            letter-spacing: 0;
            line-height: 100%;
            color: #000000;

        }

        .section-desc {
            max-width: 1124px;
            margin: 0 auto;
            font-size: 20px;
            color: #555;
            font-weight: 600;
            font-family: Inter;
            line-height: 100%;
            letter-spacing: 0;
        }

        /* Cards Wrapper */
        .cards-wrapper {
            background: #0A70A238;
        }

        /* Service Card */
        .service-card {
            width: 347px;
            height: 486px;
            border: 3px solid #076FA1;
            padding: 20px;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            border-radius: 30px;
            box-shadow: 0px 4px 14.8px #5BC3C4;
            position: relative;
        }

        /* Card Title */
        .cardd-title {
            color: #076FA1;
            font-weight: 700;
            margin-top: 10px;
            font-size: 22px;
            font-family: Inter;
            line-height: 100%;
            letter-spacing: 0;
        }

        /* HR */
        .service-card hr {
            border: none;
            border-bottom: 4px solid #020202;
            width: 284px;
            margin: 0px auto;
        }

        /* Description */
        .card-desc {
            margin-top: 16px;
            font-size: 16px;
            line-height: 160%;
            font-weight: 700;
            font-family: Arial;
            letter-spacing: 0;
            color: #000000;
            max-width: 304px;
        }

        /* Button */
        .service-card .btn-primary {
            background-color: #FFFFff;
            border-color: #FE0000D9;
            color: #0168A4;
            width: 125px;
            height: 29px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            font-weight: 700;
            line-height: 100%;
            font-family: Inter;
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
        }

        .hero-secti {
            margin-top: 130px;
        }

        .first-card-img {
            width: 142px;
            height: 113px;
            margin: 0 auto;

        }

        .s-card-img {
            width: 125px;
            height: 113px;
            margin: 0 auto;
        }

        .ss-card-img {
            width: 122px;
            height: 113px;
            margin: 0 auto;

        }

        .Seemore-btn {
            width: 351px;
            height: 50px;
            border-radius: 15px;
            background-color: #0071A8;
            border: 0;
            color: #FFFFff;
            margin-top: 30px;
            font-family: Poppins;
            font-size: 20px;
            font-weight: 700;
            line-height: 100%;
            letter-spacing: 0;
        }

        /*================== about section  =========================*/
        /* Section */
        .about-section {
            background-color: #ffffff;
        }

        /* Small heading */
        .who-we-are {
            color: #0D0D0D;
            font-weight: 700;
            letter-spacing: 0;
            font-size: 32px;
            font-family: Inter;
            line-height: 140%;
        }

        /* Main heading */
        .about-main-heading {
            color: #0D0D0D;
            font-weight: 600;
            letter-spacing: 0;
            font-size: 32px;
            font-family: Inter;
            line-height: 140%;
        }

        .about-main-heading span {
            color: #0071A8;
        }

        /* Short desc */
        .about-short-desc {
            color: #0071A8;
            font-weight: 400;
            letter-spacing: 0;
            font-size: 20px;
            font-family: Arial;
            line-height: 160%;
            max-width: 580px;
        }

        /* Icon */
        .about-icon {
            font-size: 32px;
            color: #0071A8;
            margin-top: 9px;
            margin-right: 10px;
        }

        /* Icon heading */
        .icon-heading {
            color: #0071A8;
            font-weight: 700;
            letter-spacing: 0;
            font-size: 32px;
            font-family: Inter;
            line-height: 140%;
        }

        /* Long desc */
        .about-long-desc {
            color: #000000;
            font-weight: 400;
            letter-spacing: 0;
            font-size: 20px;
            font-family: Arial;
            line-height: 160%;
            max-width: 580px;
        }

        /* Images */
        .about-img {
            width: 593px;
            height: 323px;
            max-width: 100%;
            object-fit: cover;
            border-radius: 20px;
            box-shadow: 0 0 20px #0071A8;
        }


        /* ================== end =================================== */
    </style>
@endpush

@section('frontend-content')


    <section class="hero-secti py-5">
        <div class="container text-center mb-5">
            <!-- First Heading -->
            <h2 class="main-heading fade-left">Mr. Biomed Tech</h2>

            <!-- Second Heading -->
            <h3 class="sub-heading mt-3 fade-right">
                Complete Overview of Our Biomedical Services
            </h3>

            <!-- Paragraph -->
            <p class="section-desc mt-3 fade-left">
                We cover a full spectrum of medical equipment, ensuring you have access to everything you need.
                This is the fact that hospitals and healthcare providers trust Mr. Biomed Tech Services for clear,
            </p>
        </div>

        <!-- Container Fluid with background -->
        <div class="container-fluid cards-wrapper py-5">
            <div class="container">
                <div class="row justify-content-center g-4">

                    <!-- Card 1 -->
                    <div class="col-lg-4 col-md-6 d-flex justify-content-center animate-card">
                        <div class="service-card text-center">
                            <img src="{{ asset('frontend/images/first-card-img.png') }}"
                                class="first-card-img img-fluid mb-3" alt="service">

                            <h4 class="cardd-title">Service Title</h4>
                            <hr>
                            <p class="card-desc">
                                Libero diam auctor tristique hendrerit in eu vel id. Nec leo amet suscipit nulla. Nullam
                                vitae sit tempus diam.Libero diam auctor tristique hendrerit in eu vel id. Nec leo amet
                                suscipit nulla. Nullam vitae sit tempus diam. </p>

                            <a href="#" class="btn btn-primary mt-3">Read More</a>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-lg-4 col-md-6 d-flex justify-content-center animate-card">
                        <div class="service-card text-center">
                            <img src="{{ asset('frontend/images/2nd-card-img.png') }}" class="s-card-img img-fluid mb-3"
                                alt="service">
                            <h4 class="cardd-title">Service Title</h4>
                            <hr>
                            <p class="card-desc">
                                Libero diam auctor tristique hendrerit in eu vel id. Nec leo amet suscipit nulla. Nullam
                                vitae sit tempus diam.Libero diam auctor tristique hendrerit in eu vel id. Nec leo amet
                                suscipit nulla. Nullam vitae sit tempus diam. </p>

                            <a href="#" class="btn btn-primary mt-3">Read More</a>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-lg-4 col-md-6 d-flex justify-content-center animate-card">
                        <div class="service-card text-center">
                            <img src="{{ asset('frontend/images/3rd-card-img.png') }}" class="ss-card-img img-fluid mb-3"
                                alt="service">
                            <h4 class="cardd-title">Service Title</h4>
                            <hr>
                            <p class="card-desc">
                                Libero diam auctor tristique hendrerit in eu vel id. Nec leo amet suscipit nulla. Nullam
                                vitae sit tempus diam.Libero diam auctor tristique hendrerit in eu vel id. Nec leo amet
                                suscipit nulla. Nullam vitae sit tempus diam. </p>

                            <a href="#" class="btn btn-primary mt-3">Read More</a>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button class="Seemore-btn">See more Service Details</button>
                    </div>

                </div>
            </div>
        </div>
    </section>



    <section class="features-section py-5">
        <div class="container">
            <div class="row text-white">

                <!-- Feature 1 -->
                <div
                    class="col-lg-3 col-md-6 col-12 mb-4 animate-card d-flex align-items-start justify-content-lg-start justify-content-center text-lg-start text-center">
                    <i class="bi bi-truck feature-icon"></i>
                    <div class="ms-3">
                        <h5 class="fw-bol mt-2">Free Shipping</h5>
                        <p class="small mb-0">Order over $600</p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div
                    class="col-lg-3 col-md-6 col-12 animate-card mb-4 d-flex align-items-start justify-content-lg-start justify-content-center text-lg-start text-center">
                    <i class="bi bi-credit-card feature-icon"></i>
                    <div class="ms-3">
                        <h5 class="fw-bol mt-2">Quick Payment</h5>
                        <p class="small ">100% secure</p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div
                    class="col-lg-3 col-md-6 animate-card col-12 mb-4 d-flex align-items-start justify-content-lg-start justify-content-center text-lg-start text-center">
                    <i class="bi bi-cash-coin feature-icon"></i>
                    <div class="ms-3">
                        <h5 class="fw-bol mt-1">Big Cashback</h5>
                        <p class="small ">Over 50% cash back</p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div
                    class="col-lg-3 col-md-6 animate-card mb-4 d-flex align-items-start justify-content-lg-start justify-content-center text-lg-start text-center">
                    <i class="bi bi-headset feature-icon"></i>
                    <div class="ms-3 mt-2">
                        <h5 class="fw-bold">24/7 Support</h5>
                        <p class="small">Ready for you</p>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <x-best-selling-products-section />

    <x-offers-section />

    <section class="about-section py-5 mt-4">
        <div class="container">
            <div class="row  gy-4">

                <!-- LEFT COLUMN -->
                <div class="col-lg-6 fade-left">
                    <span class="who-we-are">WHO WE ARE</span>

                    <h2 class="about-main-heading mt-2">
                        ABOUT <span>MR BIOMED TECH SERVICES</span>
                    </h2>

                    <p class="about-short-desc mt-3">
                        Mr. Biomed Tech Services is committed to delivering high-quality biomedical solutions that support
                        modern healthcare facilities. We provide reliable and innovative medical equipment services tailored
                        to the evolving needs of hospitals and clinics.
                    </p>

                    <!-- Icon + Heading -->
                    <div class="d-flex align-items-start mt-4">
                        {{-- <i class="fa-solid fa-heart-pulse about-icon me-3"></i> --}}
                        <img src="{{ asset('frontend/images/heading-icon.png') }}" class="about-icon" alt="about image">
                        <div>
                            <h5 class="icon-heading">
                                Better Quality
                            </h5>
                            <p class="about-long-desc mt-2">
                                We specialize in providing comprehensive biomedical equipment services,
                                including installation, maintenance, calibration, and technical support.
                                Our experienced team ensures reliability, safety, and compliance with
                                international healthcare standards, making us a trusted partner for
                                hospitals and healthcare providers.
                            </p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mt-4">
                        {{-- <i class="fa-solid fa-heart-pulse about-icon me-3"></i> --}}
                        <img src="{{ asset('frontend/images/heading-icon.png') }}" class="about-icon" alt="about image">

                        <div>
                            <h5 class="icon-heading">
                                Better Quality
                            </h5>
                            <p class="about-long-desc mt-2">
                                We specialize in providing comprehensive biomedical equipment services,
                                including installation, maintenance, calibration, and technical support.

                            </p>
                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN -->
                <div class="col-lg-6 fade-right">
                    <div class="row g-5">
                        <div class="col-12">
                            <img src="{{ asset('frontend/images/recent-news-img.png') }}" class="img-fluid about-img"
                                alt="about image">

                        </div>
                        <div class="col-12 ">
                            <img src="{{ asset('frontend/images/rental/rental-img.jpg') }}" class="img-fluid about-img"
                                alt="about image">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    {{-- ================= contact us section ================== --}}
    <x-contact-us-section :footer-states="$footerStates" />

    {{-- ================= pruduct sectiion ============= --}}
    <x-our-latest-products />

    {{-- ================faqs section ================ --}}
    <x-faq-section :faqs="$faqs" heading="Frequently Asked Questions" subheading="" subtext=""
        image="frontend/images/hero-main-img.png" :visible="4" />


@endsection

@push('frontend-scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const track = document.querySelector(".slider-track");
            const slides = document.querySelectorAll(".slide");

            if (!track || slides.length === 0) return;

            let index = 1;
            let total = slides.length;

            // Initial translate
            track.style.transform = `translateX(-${index * 100}%)`;

            function autoSlide() {
                index++;
                track.style.transition = "transform 0.8s ease-in-out";
                track.style.transform = `translateX(-${index * 100}%)`;

                // If clone slide reached → instantly jump to first real slide
                if (index >= total - 1) {
                    setTimeout(() => {
                        track.style.transition = "none";
                        index = 1;
                        track.style.transform = `translateX(-100%)`;
                    }, 800);
                }
            }

            setInterval(autoSlide, 3500);

        });
    </script>

    <script>
        document.querySelectorAll(".nav-item.dropdown").forEach(drop => {

            let timer;
            let menu = drop.querySelector(".mega-menu");

            drop.addEventListener("mouseenter", () => {
                clearTimeout(timer);
                menu.style.display = "block";
            });

            drop.addEventListener("mouseleave", () => {
                timer = setTimeout(() => {
                    menu.style.display = "none";
                }, 200);
            });

            menu.addEventListener("mouseenter", () => {
                clearTimeout(timer);
                menu.style.display = "block";
            });

            menu.addEventListener("mouseleave", () => {
                timer = setTimeout(() => {
                    menu.style.display = "none";
                }, 200);
            });

        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let currentImageIndex = 0;

            const imageTrack = document.querySelector(".image-slide-track");
            const slides = document.querySelectorAll(".image-slide-item");
            const totalSlides = slides.length;

            const dots = document.querySelectorAll(".image-dots .dot");

            const slideDuration = 3000;
            let slider;

            // Update dots
            function updateDots() {
                dots.forEach(dot => dot.classList.remove("active"));
                dots[currentImageIndex].classList.add("active");
            }

            // Jump to slide
            function goToSlide(index, withTransition = true) {

                if (withTransition) {
                    imageTrack.style.transition = "transform 0.8s ease-in-out";
                } else {
                    imageTrack.style.transition = "none"; // no jerk when jumping
                }

                imageTrack.style.transform = `translateX(-${index * 25}%)`;
                updateDots();
            }

            // Auto slide
            function autoSlide() {
                slider = setInterval(() => {

                    currentImageIndex++;

                    if (currentImageIndex < totalSlides) {
                        goToSlide(currentImageIndex, true);
                    } else {
                        // Last slide se pehle slide pr jump WITHOUT TRANSITION
                        currentImageIndex = 0;
                        goToSlide(currentImageIndex, false);
                    }

                }, slideDuration);
            }

            // Click dots
            dots.forEach(dot => {
                dot.addEventListener("click", function() {
                    clearInterval(slider);
                    currentImageIndex = parseInt(this.dataset.index);
                    goToSlide(currentImageIndex, true);
                    autoSlide();
                });
            });

            // Initialize
            goToSlide(0, false);
            autoSlide();
        });
    </script>
@endpush
