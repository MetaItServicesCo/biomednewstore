    <style>
        .see-all-btn {
            width: 157px;
            height: 50px;
            background-color: #0071A8;
            border-radius: 15px;
            font-family: Poppins;
            font-size: 20px;
            font-weight: 700;
            line-height: 100%;
            letter-spacing: 0;
            border: 0;
            color: #ffffff;
            /* margin-right: 20px; */
            /* margin-left: 110px; */
        }

        .wraperr {
            max-width: 1166px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .offer-tittle {
            font-family: Inter;
            font-size: 45px;
            font-weight: 600;
            line-height: 100%;
            letter-spacing: 0;
            color: #000000;
            max-width: 961px;
        }


        .offer-card {
            width: 260px;
            height: 394px;
            border: 1px solid #0071A8;
            border-radius: 13px;
            background: #fff;
            padding: 0;
            box-sizing: border-box;
            position: relative;
            overflow: hidden;
        }

        /* Image */
        .offer-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }

        /* Card Body */
        .offer-card .card-body {
            height: calc(394px - 200px);
            /* ✔ exact fit */
            background-color: #C9E0EB;
            padding: 10px;
            box-sizing: border-box;
            border-bottom-left-radius: 13px;
            border-bottom-right-radius: 13px;
            margin: 0;
        }


        .offerr-desc {
            max-width: 1166px;
            font-family: Arial;
            font-size: 16px;
            font-weight: 700;
            line-height: 160%;
            letter-spacing: 0;
            margin-top: 20px;

        }

        .price {
            margin-top: -12px;
        }

        .offer-readd-btn {
            width: 149px;
            height: 40px;
            border-radius: 15px;
            background-color: #0071A8;
            color: #ffffff;
            border: 0;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: 6px;
        }

        /* ============ new css ================== */
        .offerSwiper {
            padding: 15px 0;
        }

        /* Swiper slide auto height */
        .offerSwiper .swiper-slide {
            height: auto;
            display: flex;
            justify-content: center;
        }

        /* Swiper arrows styling */
        .offer-prev,
        .offer-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: #004A6D;
            color: #fff;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            z-index: 10;

            display: flex;
            align-items: center;
            justify-content: center;

            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        @media(max-width:768px) {

            .offer-prev {
                left: -15px !important;
            }

            .offer-next {
                right: -15px !important;
            }
        }

        @media(max-width:767px) {

            .offer-prev,
            .offer-next {
                display: none;
            }
        }

        /* Position same as before */
        .offer-prev {
            left: -58px;
        }

        .offer-next {
            right: -50px;
        }

        /* Icon size */
        .offer-prev i,
        .offer-next i {
            font-size: 18px;
        }

        /* Hover effect (modern) */
        .offer-prev:hover,
        .offer-next:hover {
            background: #076FA1;
            transform: translateY(-50%) scale(1.1);
        }


        /* Pagination dots */
        .offer-pagination .swiper-pagination-bullet {
            background: #bbb;
            opacity: 1;
        }

        .offer-pagination .swiper-pagination-bullet-active {
            background: #076FA1;
            transform: scale(1.3);
        }

        .swiper-button-prev::after,
        .swiper-button-next::after {
            display: none !important;
        }
    </style>

    <section class="offer-section mt-5">
        <div class="container">

            <!-- Heading -->
            <div class=" wraperr">
                <h2 class="text-center offer-tittle fade-left">Grateful for Caregivers. Committed to Care.</h2>
                <a href="{{ route('products') }}">
                    <button class="see-all-btn">See All</button>
                </a>

            </div>

            <p class="text-center offerr-desc mb-5 fade-right">
                Healthcare teams deserve equipment they can trust. That’s why we focus on quality products, clear
                recommendations, and helpful support—so you can spend less time troubleshooting and more time caring for
                patients.
            </p>

            <!-- Slider Wrapper -->
            <div class="offer-slider-wrapper position-relative">

                <!-- Prev Button -->
                <div class="swiper-button-prev offer-prev">
                    <i class="bi bi-chevron-left"></i>
                </div>

                <!-- Slider -->
                <div class="swiper offerSwiper">
                    <div class="swiper-wrapper pb-3">

                        @foreach ($p as $product)
                            <div class="swiper-slide">
                                <div class="offer-card">
                                    <img src="{{ $product->thumbnail ? asset('storage/products/thumbnails/' . $product->thumbnail) : '' }}"
                                        alt="{{ $product->image_alt ?? $product->name }}" class="card-img img-fluid">

                                    <div class="card-body border-0">
                                        <p class="card-desc">{{ $product->name }}</p>
                                        <p class="price text-danger text-center">
                                            ${{ number_format($product->sale_price, 2) }}
                                        </p>

                                        <button class="offer-readd-btn" data-id="{{ $product->id }}" data-qty="1">
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <!-- Pagination -->
                    <div class="swiper-pagination offer-pagination"></div>
                </div>

                <!-- Next Button -->
                <div class="swiper-button-next offer-next">
                    <i class="bi bi-chevron-right"></i>
                </div>

            </div>




        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            new Swiper(".offerSwiper", {
                slidesPerView: 4,
                spaceBetween: 22,
                loop: true,
                speed: 1200, // smooth luxury motion
                grabCursor: true,

                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true, // ✅ hover pause
                },

                navigation: {
                    nextEl: ".offer-next",
                    prevEl: ".offer-prev",
                },

                pagination: {
                    el: ".offer-pagination",
                    clickable: true,
                },

                breakpoints: {
                    0: {
                        slidesPerView: 1
                    },
                    576: {
                        slidesPerView: 2
                    },
                    992: {
                        slidesPerView: 3
                    },
                    1200: {
                        slidesPerView: 4
                    }
                }
            });

        });
    </script>
