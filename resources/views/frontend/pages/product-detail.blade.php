@extends('frontend.layouts.frontend')

{{-- @section('title', 'Home') --}}
@section('meta_title', $data->meta_title ?? 'Mr. Biomed Tech Services')
@section('meta_keywords', $data->meta_keywords ?? '')
@section('meta_description', $data->meta_description ?? '')

@push('frontend-styles')
    <style>
        .product-title {
            font-size: 28px;
            font-weight: 600;
            font-family: Inter;
            line-height: 100%;
            letter-spacing: 0;
            margin-top: 40px;
            color: #000000;
        }

        .meta {
            font-size: 12px;
            font-weight: 700;
            font-family: Inter;
            line-height: 100%;
            color: #000000;
            letter-spacing: 0;
            margin-top: 20px;

        }

        .product-price {
            font-size: 18px;
            font-weight: 600;
            font-family: Inter;
            line-height: 100%;
            color: #F20000;
            letter-spacing: 0;
            margin-top: 30px;
        }

        .rating i {
            color: #F4B400;
            font-size: 22px;
            margin-right: 3px;
        }

        .options-title {
            font-size: 12px;
            font-weight: 700;
            font-family: Inter;
            line-height: 100%;
            color: #000000;
            letter-spacing: 0;
            margin-top: 20px;
        }

        /* Quantity */
        .quantity-box {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            /* ✅ spacing between items */
            margin-top: 40px;
        }

        /* Minus & Plus common */
        .qty-btn {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 20px;
            font-weight: 600;
            user-select: none;
            transition: background 0.3s;
        }

        /* Minus button */
        .qty-btn.minus {
            background: #CCEFFF;
            /* grey */
            color: #787878;
            border-top-left-radius: 6px;
            border-bottom-left-radius: 6px;

        }

        /* Plus button */
        .qty-btn.plus {
            background: #CCEFFF;
            /* blue */
            color: #787878;
            border-top-right-radius: 6px;
            border-bottom-right-radius: 6px;
        }

        /* Number */
        .qty-number {
            background: #CCEFFF;
            /* light blue */
            padding: 6px 18px;
            font-weight: 600;
            min-width: 40px;
            text-align: center;
        }

        /* Hover effect */
        .qty-btn:hover {
            opacity: 0.75;
        }


        /* Add to Cart */
        .add-to-cart-btn {
            background: #0071A8;
            color: #ffffff;
            font-size: 14px;
            font-weight: 600;
            font-family: Inter;
            line-height: 100%;
            border-radius: 15px;
            border: none;
            display: block;
            margin-top: 50px;
            width: 234px;
            height: 48px;
            transition: all 0.3s ease-in-out;
        }

        .add-to-cart-btn:hover {
            background: #015986;
        }

        /*===================== product detail banner  ============================*/
        .product-detail-banner {
            background: linear-gradient(90deg, #006A9E, #A5CDE0);
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-top: 180px;
        }

        .product-detail-banner h1 {
            font-size: 50px;
            font-weight: 700;
            color: #ffffff;
            line-height: 120%;
            letter-spacing: 0;
            margin: 0;
            font-family: Arial;
        }

        .product-detail-banner h1 span {
            color: #000000;
        }

        /* ---------- Responsive ---------- */
        @media (max-width: 768px) {
            .product-detail-banner {
                height: 180px;
            }

            .product-detail-banner h1 {
                font-size: 36px;
            }
        }

        @media (max-width: 480px) {
            .product-detail-banner h1 {
                font-size: 28px;
            }
        }

        /* ====================== end ==================================== */

        /* ============ product tab css ==================== */
        .product-tabs {
            margin-top: 120px;
        }

        /* Tabs Buttons */
        .tab-buttons {
            display: flex;
            gap: 12px;
        }

        .tab-btn {
            width: 141px;
            height: 41px;
            background: #FFFFFF;
            border: 1px solid #0071A8;
            color: #000000;
            font-weight: 700;
            font-size: 18px;
            font-family: Inter;
            line-height: 100%;
            letter-spacing: 0;
            cursor: pointer;
            transition: all 0.3s ease;
            border-radius: 15px;
        }

        .tab-btn.active {
            background: #006A9E;
            color: #ffffff;
        }

        /* Content */
        .tab-content {
            display: none;
            margin-top: 20px;
            color: #333;
            line-height: 170%;
            max-width: 1118px;
        }

        .tab-content.active {
            display: block;
        }

        /* Action Buttons */
        .tab-actions {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        /* Common Button */
        .action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;

            width: 150px;
            height: 43px;

            background: #0168A4;
            border: none;
            color: #fff;

            font-weight: 600;
            font-size: 15px;

            cursor: pointer;
            border-radius: 10px;
            transition: background 0.3s;
        }

        /* Icon */
        .action-btn i {
            font-size: 18px;
            font-weight: 800;
        }

        /* Download Button */
        .action-btn.download {
            width: 188px;
        }

        /* PDF Icon */
        .action-btn.download img {
            width: 18px;
            height: 18px;
            object-fit: contain;
        }

        /* Hover */
        .action-btn:hover {
            background: #005a8d;
        }


        .action-btn:hover {
            opacity: 0.85;
        }

        /* ======================= end ========================= */
    </style>
@endpush

@section('frontend-content')

    <section class="product-detail-banner">
        <h1>Product <span>Detail page</span> </h1>
    </section>




    <section>

        <div class="container">
            <div class="row">
                <div class="col-lg-6">

                    <div class="image-slider">
                        <!-- Main Image -->
                        <img id="mainImage" src="{{ asset('frontend/images/recent-news-img.png') }}" class="main-img">
                    </div>

                    <div class="thumb-slider-container">

                        <!-- Prev Button -->
                        <button class="thumb-prev">&#10094;</button>

                        <!-- Thumbnails -->
                        <div class="thumb-wrapper">
                            <div class="thumbs-track" id="thumbsTrack">
                                <img src="{{ asset('frontend/images/recent-news-img.png') }}" class="thumb"
                                    onclick="thumbClicked(this.src)">

                                <img src="{{ asset('frontend/images/rental/rental-img.jpg') }}" class="thumb"
                                    onclick="thumbClicked(this.src)">

                                <img src="{{ asset('frontend/images/thumb-3.jpg') }}" class="thumb"
                                    onclick="thumbClicked(this.src)">

                                <img src="{{ asset('frontend/images/thumb-4.jpg') }}" class="thumb"
                                    onclick="thumbClicked(this.src)">

                                <img src="{{ asset('frontend/images/thumb-5.jpg') }}" class="thumb"
                                    onclick="thumbClicked(this.src)">
                            </div>
                        </div>


                        <!-- Next Button -->
                        <button class="thumb-next">&#10095;</button>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        <div class="pagination-bar" id="paginationBar"></div>
                    </div>

                </div>
                <div class="col-lg-6">

                    <!-- Product Title -->
                    <h2 class="product-title">Welch Allyn CP 150 ECG System</h2>

                    <!-- SKU / Condition / Availability -->
                    <p class="meta"><strong>SKU:</strong> ECG-150</p>
                    <p class="meta"><strong>CONDITION:</strong> New</p>
                    <p class="meta"><strong>AVAILABILITY:</strong> In Stock</p>

                    <hr>

                    <!-- Price -->
                    <h3 class="product-price">$3,586.95</h3>

                    <!-- Rating -->
                    <div class="rating mt-4">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>

                    <hr>

                    <!-- Options -->
                    <p class="options-title"><strong>OPTIONS:</strong> REQUIRED</p>
                    <ul class="my-4">
                        <li class="options-title">CP150_INT,AHA,D,EN,NA_PCORD</li>
                    </ul>

                    <hr>

                    <!-- Quantity -->
                    <div class="quantity-box">
                        <span class="qty-btn minus">-</span>
                        <span class="qty-number">1</span>
                        <span class="qty-btn plus">+</span>
                    </div>


                    <!-- Add to Cart -->
                    <button class=" add-to-cart-btn ">
                        Add to Cart
                    </button>

                </div>

            </div>
        </div>
        <div class="product-tabs  container">

            <!-- Tabs Buttons -->
            <div class="tab-buttons">
                <button class="tab-btn active" data-tab="desc">DESCRIPTION</button>
                <button class="tab-btn" data-tab="brochure">BROCHURES</button>
            </div>

            <hr>

            <!-- Tab Contents -->

            <!-- DESCRIPTION -->
            <div class="tab-content active" id="desc">
                <p>
                    The Welch Allyn CP 150 Electrocardiograph (ECG) offers simplicity with speed using a unique,
                    7" touch-screen display and keyboard helping to improve accuracy.
                </p>

                <p>
                    To meet the needs of fast-paced environments, take quick ECG readings with the touch of a
                    button. And with a range of advanced connectivity features, help improve your practice
                    workflow by sending, managing, and sharing patient data with systems inside or outside
                    your facility.
                </p>

                <p>
                    The Welch Allyn CP 150 Electrocardiograph (ECG) offers simplicity with speed using a unique,
                    7" touch-screen display and keyboard helping to improve accuracy.
                </p>
            </div>

            <!-- BROCHURES -->
            <div class="tab-content" id="brochure">
                <p>
                    Download product brochures, manuals, and technical documentation for the
                    Welch Allyn CP 150 ECG System.
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="tab-actions">

                <!-- See More -->
                <button class="action-btn">
                    <span>See More</span>
                    <i class="bi bi-chevron-down dropdown-icon"></i>
                </button>

                <!-- Download PDF -->
                <button class="action-btn download">
                    <span>Download PDF</span>
                    <img src="{{ asset('frontend/images/detail-icon.png') }}" alt="PDF">
                </button>

            </div>


        </div>

    </section>







    {{-- ================= pruduct sectiion ============= --}}
    <x-our-latest-products />

    {{-- ================faqs section ================ --}}
    {{-- <x-faq-section :faqs="$faqs" heading="Frequently Asked Questions" subheading="" subtext=""
        image="frontend/images/hero-main-img.png" :visible="4" /> --}}


@endsection

@push('frontend-scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const mainImage = document.getElementById("mainImage");
            const thumbTrack = document.getElementById("thumbsTrack");
            const paginationBar = document.getElementById("paginationBar");
            const prevBtn = document.querySelector(".thumb-prev");
            const nextBtn = document.querySelector(".thumb-next");

            if (!mainImage || !thumbTrack || !paginationBar) {
                console.warn("Slider elements not found!");
                return;
            }

            let offset = 0;
            const visibleThumbs = 4;
            const thumbWidth = 92;

            let thumbElements = document.querySelectorAll(".thumb");

            /** ------------------------------------------
             *  1: Set DEFAULT MAIN IMAGE + ACTIVE THUMB
             * ------------------------------------------ */

            if (thumbElements.length > 0) {
                const firstSrc = thumbElements[0].getAttribute("src");
                mainImage.src = firstSrc;

                thumbElements[0].classList.add("active-thumb");
            }

            /** ------------------------------------------
             *  2: Pagination Setup
             * ------------------------------------------ */
            const totalPages = Math.ceil(thumbElements.length / visibleThumbs);

            for (let i = 0; i < totalPages; i++) {
                let seg = document.createElement("div");
                seg.classList.add("pg-segment");
                seg.dataset.page = i;
                paginationBar.appendChild(seg);
            }

            const pgSegments = document.querySelectorAll(".pg-segment");

            function setActivePage(page) {
                pgSegments.forEach(seg => seg.classList.remove("active"));
                if (pgSegments[page]) pgSegments[page].classList.add("active");
            }
            setActivePage(0);

            function goToPage(page) {
                offset = -(page * visibleThumbs * thumbWidth);
                thumbTrack.style.transform = `translateX(${offset}px)`;
                setActivePage(page);
            }

            pgSegments.forEach(seg => {
                seg.onclick = () => goToPage(parseInt(seg.dataset.page));
            });

            if (prevBtn) {
                prevBtn.onclick = () => {
                    let currentPage = Math.abs(offset / (visibleThumbs * thumbWidth));
                    if (currentPage > 0) goToPage(currentPage - 1);
                };
            }

            if (nextBtn) {
                nextBtn.onclick = () => {
                    let currentPage = Math.abs(offset / (visibleThumbs * thumbWidth));
                    if (currentPage < totalPages - 1) goToPage(currentPage + 1);
                };
            }

            /** ------------------------------------------
             *  3: On Thumbnail Click → update main + active
             * ------------------------------------------ */
            window.thumbClicked = function(src) {
                mainImage.src = src;

                // Remove previous active thumb
                thumbElements.forEach(t => t.classList.remove("active-thumb"));

                // Add active class to clicked thumb
                const clickedThumb = [...thumbElements].find(t => t.src === src);
                if (clickedThumb) clickedThumb.classList.add("active-thumb");
            };
        });
    </script>
    <script>
        const qtyBox = document.querySelector('.quantity-box');
        const qtyNumber = qtyBox.querySelector('.qty-number');

        qtyBox.addEventListener('click', function(e) {
            let qty = parseInt(qtyNumber.innerText);

            if (e.target.innerText === '+') {
                qtyNumber.innerText = qty + 1;
            }
            if (e.target.innerText === '-' && qty > 1) {
                qtyNumber.innerText = qty - 1;
            }
        });
    </script>
    <script>
        const tabButtons = document.querySelectorAll(".tab-btn");
        const tabContents = document.querySelectorAll(".tab-content");

        tabButtons.forEach(btn => {
            btn.addEventListener("click", () => {

                // Remove active from all
                tabButtons.forEach(b => b.classList.remove("active"));
                tabContents.forEach(c => c.classList.remove("active"));

                // Activate clicked
                btn.classList.add("active");
                document.getElementById(btn.dataset.tab).classList.add("active");
            });
        });
    </script>
@endpush
