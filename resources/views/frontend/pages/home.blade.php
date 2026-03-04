@extends('frontend.layouts.frontend')

{{-- @section('title', 'Home') --}}
@section('meta_title', $data->meta_title ?? 'Mr. Biomed Tech Services | Reliable Biomedical Solutions')
@section('meta_keywords', $data->meta_keywords ?? '')
@section('meta_description',
    $data->meta_description ??
    'Mr. Biomed Tech Services delivers biomedical
    solutions—installation to repair. Visit 555 N 5th St, Garland, TX. Call +1 469-767-8853. Fast & reliable.')


@section('page_schema')
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "WebSite",
          "name": "MBMTS",
          "url": "https://mbmts.com/",
          "potentialAction": {
            "@type": "SearchAction",
            "target": "https://mbmts.com/store?search={search_term_string}",
            "query-input": "required name=search_term_string"
          }
        }
    </script>

    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "MedicalBusiness",
          "@id": "https://mbmts.com/#localbusiness",
          "name": "MBMTS",
          "image": "https://www.mrbiomedtechservices.com/storage/uploads/settings/1769617213_mr%20biomed%20tech%20servics.png",
          "url": "https://mbmts.com/",
          "telephone": "+1-469-767-8853",
          "priceRange": "$$",
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "555 N. 5th St, Suite 109 B",
            "addressLocality": "Garland",
            "addressRegion": "TX",
            "postalCode": "75040",
            "addressCountry": "US"
          },
          "geo": {
            "@type": "GeoCoordinates",
            "latitude": "32.9126",
            "longitude": "-96.6389"
          },
          "areaServed": {
            "@type": "State",
            "name": "Texas"
          },
          "openingHoursSpecification": [
            {
              "@type": "OpeningHoursSpecification",
              "dayOfWeek": [
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday"
              ],
              "opens": "08:00",
              "closes": "17:00"
            }
          ],
          "sameAs": [
            "https://www.facebook.com/Mr.BioMed/",
            "https://www.instagram.com/mr.biomedtechservices/",
            "https://www.linkedin.com/company/mr-biomed-tech-pt-medical"
          ]
        }
    </script>

    @php
        $breadcrumbProducts = \App\Models\Product::where('is_active', true)->get();
    @endphp
    @if ($breadcrumbProducts->isNotEmpty())
        <script type="application/ld+json">
            {
              "@context": "https://schema.org",
              "@type": "BreadcrumbList",
              "itemListElement": [
                {
                  "@type": "ListItem",
                  "position": 1,
                  "name": "Home",
                  "item": "{{ url('/') }}"
                },
                {
                  "@type": "ListItem",
                  "position": 2,
                  "name": "Store",
                  "item": "{{ route('products') }}"
                }@foreach ($breadcrumbProducts as $index => $breadcrumbProduct)
                ,{
                  "@type": "ListItem",
                  "position": {{ $index + 3 }},
                  "name": @json($breadcrumbProduct->name),
                  "item": "{{ strtolower($breadcrumbProduct->product_type ?? '') === 'part' ? url('parts/' . $breadcrumbProduct->slug) : url('products/' . $breadcrumbProduct->slug) }}"
                }
                @endforeach
              ]
            }
        </script>
    @endif
@endsection
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
            font-size: 50px;
            font-weight: 900;
            font-family: Arial;
            letter-spacing: 0;
            line-height: 100%;
            color: #0168A4;
        }

        .sub-heading {
            font-size: 37px;
            font-weight: 900;
            font-family: Arial;
            letter-spacing: 0;
            line-height: 100%;
            color: #000000;

        }

        .section-desc {
            max-width: 1124px;
            margin: 0 auto;
            font-size: 18px;
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
        /* .service-card {
                                                                                        width: 100%;
                                                                                        max-width: 347px;
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
                                                                                        margin: 0 auto;
                                                                                    } */

        .service-card {
            width: 100%;
            max-width: 347px;
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
            margin: 0 auto;

            animation-name: floatUpDown;
            animation-duration: 4s;
            animation-timing-function: ease-in-out;
            animation-iteration-count: infinite;

            /* smooth hover */
            transition: transform 0.6s ease, box-shadow 0.6s ease;


        }

        .delay-1 {
            animation-delay: 0s;
        }

        .delay-2 {
            animation-delay: 1s;
        }

        .delay-3 {
            animation-delay: 1.9s;
        }

        /* =========================
                                                           FLOAT COMBO ANIMATION
                                                        ========================= */
        @keyframes floatUpDown {
            0% {
                transform: translateY(0);
            }

            25% {
                transform: translateY(-10px);
            }

            50% {
                transform: translateY(-18px);
            }

            75% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0);
            }
        }

        /* =========================
                                                           HOVER EFFECT
                                                        ========================= */
        .service-card:hover {
            transform: translateY(-20px) scale(1.05);
            box-shadow: 0px 20px 40px rgba(91, 195, 196, 0.85);
            animation-play-state: paused;
        }

        /* =========================
                                                           RESPONSIVE
                                                        ========================= */
        @media (max-width: 768px) {
            .service-card {
                height: auto;
                min-height: 420px;
            }
                 .cardd-title {
      
            font-size: 20px !important;
          
        }
         .card-desc {
            margin-top: 10px !important;
            font-size: 14px !important;
        
        }
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
            width: 100%;
            max-width: 284px;
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
            transition: all 0.4s ease-in-out;
        }

        .service-card .btn-primary:hover {
            background-color: #0168A4;
            border: none;
            color: #ffffff;
        }

        .hero-secti {
            margin-top: 150px;
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
            transition: all 0.4s ease-in-out;
        }

        .Seemore-btn:hover {
            background-color: #025782;

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
            color: #000000;
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

        @media(max-width:768px) {
            .see-all-btn {

                margin: 15px auto !important;
            }

            .small {
                max-width: 190px !important;
            }
        }

        @media(max-width:767px) {
            .pro-section {
                margin-top: 700px;
            }

            .sub-heading {
                font-size: 20px !important;

            }

            .section-desc {
                font-size: 14px !important;

            }

            .offer-tittle {
                font-size: 30px !important;

            }

            .see-all-btn {

                margin: 10px auto !important;
            }

            .offerr-desc {

                font-size: 13px !important;

            }


            .small {
                max-width: 190px !important;
            }
        }

        /* ================== end =================================== */
    </style>
@endpush

@section('frontend-content')


    <section class="hero-secti py-5">
        <div class="container text-center mb-5">
            <!-- First Heading -->
            <h1 class="main-heading fade-left">Mr. Biomed Tech Services</h1>

            <!-- Second Heading -->
            <h2 class="sub-heading mt-3 fade-right">
                Medical Equipment, Supplies & Parts — One Place, Hassle-Free
            </h2>

            <!-- Paragraph -->
            <p class="section-desc mt-3 fade-left">
                We help hospitals, clinics, labs, and home-care providers find reliable biomedical equipment, genuine parts,
                and responsive technical support. Whether you’re buying new essentials, replacing accessories, or scheduling
                service—our team makes it simple to choose the right solution.
            </p>
        </div>

        <!-- Container Fluid with background -->
        <div class="container-fluid cards-wrapper py-5">
            <div class="container">
                <div class="row justify-content-center g-4">

                    <!-- Card 1 -->
                    <div class="col-lg-4 col-md-6 d-flex justify-content-center animate-card">
                        <div class="service-card text-center delay-1">
                            <img src="{{ asset('frontend/images/mrbiomed store services icons/Rent New and Refurbished Patient- Medical Equipment icon.svg') }}"
                                class="first-card-img img-fluid mb-3" alt="service">

                            <h4 class="cardd-title">New & Pre-Owned Medical Equipment Sales</h4>
                            <hr>
                            <p class="card-desc">
                                Renting with us saves you from initial large investment fees, the unnecessary storage costs
                                for housing idle machines, and expensive maintenance bills.
                            </p>

                            <a href="{{ rtrim(env('BIO_MED_WEBSITE'), '/') }}/rental-services"
                                class="btn btn-primary mt-3">Read More</a>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-lg-4 col-md-6 d-flex justify-content-center animate-card">
                        <div class="service-card text-center delay-2">
                            <img src="{{ asset('frontend/images/mrbiomed store services icons/2.svg') }}"
                                class="s-card-img img-fluid mb-3" alt="service">
                            <h4 class="cardd-title">Inspection, Calibration, & Repair</h4>
                            <hr>
                            <p class="card-desc">
                                MBMTS offers reliable medical equipment calibration and repair services to ensure accuracy,
                                safety, and compliance with healthcare standards.</p>

                            <a href="{{ rtrim(env('BIO_MED_WEBSITE'), '/') }}/medical-equipment-repair"
                                class="btn btn-primary mt-3">Read More</a>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-lg-4 col-md-6 d-flex justify-content-center animate-card">
                        <div class="service-card text-center delay-3">
                            <img src="{{ asset('frontend/images/mrbiomed store services icons/Disposition & Retired Assets Services.svg') }}"
                                class="ss-card-img img-fluid mb-3" alt="service">
                            <h4 class="cardd-title">Dis-positioning & Retired Assets Services</h4>
                            <hr>
                            <p class="card-desc">
                                MBMTS takes over the full lifecycle of retired assets, from evaluation and secure removal to
                                environmentally responsible disposal, donation, or resale..</p>

                            <a href="{{ rtrim(env('BIO_MED_WEBSITE'), '/') }}/retired-assets-services"
                                class="btn btn-primary mt-3">Read More</a>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <a href="{{ rtrim(env('BIO_MED_WEBSITE'), '/') }}/services">
                            <button class="Seemore-btn">See more Service Details</button>
                        </a>
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
                        <p class="small mb-0">On eligible orders over $15000</p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div
                    class="col-lg-3 col-md-6 col-12 animate-card mb-4 d-flex align-items-start justify-content-lg-start justify-content-center text-lg-start text-center">
                    <i class="bi bi-credit-card feature-icon"></i>
                    <div class="ms-3">
                        <h5 class="fw-bol mt-2">Secure Payments</h5>
                        <p class="small ">Safe checkout with multiple payment options</p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div
                    class="col-lg-3 col-md-6 animate-card col-12 mb-4 d-flex align-items-start justify-content-lg-start justify-content-center text-lg-start text-center">
                    <i class="bi bi-cash-coin feature-icon"></i>
                    <div class="ms-3">
                        <h5 class="fw-bol mt-1">Best Value Deals</h5>
                        <p class="small ">Bundles, seasonal offers, and smart savings</p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div
                    class="col-lg-3 col-md-6 animate-card mb-4 d-flex align-items-start justify-content-lg-start justify-content-center text-lg-start text-center">
                    <i class="bi bi-headset feature-icon"></i>
                    <div class="ms-3 mt-2">
                        <h5 class="fw-bold">Support</h5>
                        <p class="small">Reach us anytime—we respond as soon as possible</p>
                    </div>
                </div>


            </div>
        </div>
    </section>

    @php
        $hasProducts = ($products ?? collect())->isNotEmpty();
    @endphp

    @if ($hasProducts)
        <x-best-selling-products-section />

        <x-offers-section />
    @endif

    <section class="about-section py-5 mt-4">
        <div class="container">
            <div class="row  gy-4">

                <!-- LEFT COLUMN -->
                <div class="col-lg-6 fade-left">
                    <span class="who-we-are">Who We Are</span>

                    <h2 class="about-main-heading mt-2">
                        About <span>Mr. Biomed Tech Services</span>
                    </h2>

                    <p class="about-short-desc mt-3">
                        Mr. Biomed Tech Services is committed to delivering dependable biomedical solutions for hospitals,
                        clinics, labs, and home-care settings. We provide a complete range of support—from product sourcing
                        and parts to installation, preventive maintenance, calibration, and repair—so your equipment stays
                        safe, accurate, and ready for use.
                    </p>

                    <!-- Icon + Heading -->
                    <div class="d-flex align-items-start mt-4">
                        {{-- <i class="fa-solid fa-heart-pulse about-icon me-3"></i> --}}
                        <img src="{{ asset('frontend/images/heading-icon.png') }}" class="about-icon" alt="about image">
                        <div>
                            <h3 class="icon-heading">
                                Better Quality
                            </h3>
                            <p class="about-long-desc mt-2">
                                We supply carefully selected biomedical equipment and accessories that meet practical
                                clinical needs—balancing performance, durability, and value.
                            </p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mt-4">
                        {{-- <i class="fa-solid fa-heart-pulse about-icon me-3"></i> --}}
                        <img src="{{ asset('frontend/images/heading-icon.png') }}" class="about-icon" alt="about image">

                        <div>
                            <h3 class="icon-heading">
                                Technical Expertise
                            </h3>
                            <p class="about-long-desc mt-2">
                                Our service approach is built on structured diagnostics, careful repairs, and final
                                verification—so you get solutions that last, not quick fixes.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN -->
                <div class="col-lg-6 fade-right">
                    <div class="row g-5">
                        <div class="col-12">
                            <img src="{{ asset('frontend/images/better-img.jpg') }}" class="img-fluid about-img"
                                alt="about image">

                        </div>
                        <div class="col-12 ">
                            <img src="{{ asset('frontend/images/tech.jpg') }}" class="img-fluid about-img"
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
    @if ($hasProducts)
        <div class="pro-section">
            <x-our-latest-products />

        </div>
    @endif

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
