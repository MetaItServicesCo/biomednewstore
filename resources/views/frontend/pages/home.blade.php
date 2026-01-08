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

        /* WRAPPER */



        /* SLIDE PANEL */
    </style>
@endpush

@section('frontend-content')


    <section class="hero-section py-5">
        <div class="container">
           
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
