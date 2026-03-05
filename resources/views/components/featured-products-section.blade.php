    <style>
        .featured-offer-section .see-all-btn {
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

        .featured-offer-section .wraperr {
            /* max-width: 1166px; */
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .featured-offer-section .offer-tittle {
            font-family: Inter;
            font-size: 45px;
            font-weight: 600;
            line-height: 100%;
            letter-spacing: 0;
            color: #000000;
            /* max-width: 961px; */
            margin: 0 auto;
        }


        .featured-offer-section .offer-card {
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
        .featured-offer-section .offer-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }

        /* Card Body */
        .featured-offer-section .offer-card .card-body {
            height: calc(394px - 200px);
            /* ✔ exact fit */
            background-color: #C9E0EB;
            padding: 10px;
            box-sizing: border-box;
            border-bottom-left-radius: 13px;
            border-bottom-right-radius: 13px;
            margin: 0;
        }


        .featured-offer-section .offerr-desc {
            /* max-width: 1166px; */
            font-family: Arial;
            font-size: 16px;
            font-weight: 700;
            line-height: 160%;
            letter-spacing: 0;
            margin-top: 20px;

        }

        .featured-offer-section .price {
            margin-top: -12px;
        }

        .featured-offer-section .offer-readd-btn {
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
        .featured-offer-section .featured-offer-swiper {
            padding: 15px 0;
        }

        /* Swiper slide auto height */
        .featured-offer-section .featured-offer-swiper .swiper-slide {
            height: auto;
            display: flex;
            justify-content: center;
        }

        /* Swiper arrows styling */
        .featured-offer-section .featured-offer-prev,
        .featured-offer-section .featured-offer-next {
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

            .featured-offer-section .featured-offer-prev {
                left: -15px !important;
            }

            .featured-offer-section .featured-offer-next {
                right: -15px !important;
            }
        }

        @media(max-width:767px) {

            .featured-offer-section .featured-offer-prev,
            .featured-offer-section .featured-offer-next {
                display: none;
            }
        }

        /* Position same as before */
        .featured-offer-section .featured-offer-prev {
            left: -58px;
        }

        .featured-offer-section .featured-offer-next {
            right: -50px;
        }

        /* Icon size */
        .featured-offer-section .featured-offer-prev i,
        .featured-offer-section .featured-offer-next i {
            font-size: 18px;
        }

        /* Hover effect (modern) */
        .featured-offer-section .featured-offer-prev:hover,
        .featured-offer-section .featured-offer-next:hover {
            background: #076FA1;
            transform: translateY(-50%) scale(1.1);
        }


        /* Pagination dots */
        .featured-offer-section .featured-offer-pagination .swiper-pagination-bullet {
            background: #bbb;
            opacity: 1;
        }

        .featured-offer-section .featured-offer-pagination .swiper-pagination-bullet-active {
            background: #076FA1;
            transform: scale(1.3);
        }

        .featured-offer-section .swiper-button-prev::after,
        .featured-offer-section .swiper-button-next::after {
            display: none !important;
        }
    </style>

    @if ($p->isNotEmpty())
    <section class="offer-section mt-5 featured-offer-section">
        <div class="container">

            <!-- Heading -->
            <div class=" wraperr">
                <h2 class="text-center offer-tittle fade-left">Featured Products</h2>
            </div>

            <p class="text-center offerr-desc mb-5 fade-right">
               Take a Look at Our Featured Products - Handpicked for You!
            </p>

            <!-- Slider Wrapper -->
            <div class="offer-slider-wrapper position-relative">

                <!-- Prev Button -->
                <div class="swiper-button-prev featured-offer-prev">
                    <i class="bi bi-chevron-left"></i>
                </div>

                <!-- Slider -->
                <div class="swiper featured-offer-swiper">
                    <div class="swiper-wrapper pb-3">

                        @foreach ($p as $product)
                        <a href="{{ route('product-detail', $product->slug ?? '') }}">
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
                        </a>
                        @endforeach

                    </div>

                    <!-- Pagination -->
                    <div class="swiper-pagination featured-offer-pagination"></div>
                </div>

                <!-- Next Button -->
                <div class="swiper-button-next featured-offer-next">
                    <i class="bi bi-chevron-right"></i>
                </div>

            </div>




        </div>
    </section>
    @endif
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const featuredSection = document.querySelector(".featured-offer-section");
            if (!featuredSection) {
                return;
            }

            if (typeof Swiper === 'undefined') {
                console.warn('Swiper is not available for featured products.');
                return;
            }

            const featuredSwiper = featuredSection.querySelector(".featured-offer-swiper");
            if (!featuredSwiper) {
                return;
            }

            const slides = featuredSwiper.querySelectorAll('.swiper-slide');
            if (slides.length === 0) {
                return;
            }

            const featuredNext = featuredSection.querySelector(".featured-offer-next");
            const featuredPrev = featuredSection.querySelector(".featured-offer-prev");
            const featuredPagination = featuredSection.querySelector(".featured-offer-pagination");

            const navigation = featuredNext && featuredPrev ? {
                nextEl: featuredNext,
                prevEl: featuredPrev,
            } : undefined;

            const pagination = featuredPagination ? {
                el: featuredPagination,
                clickable: true,
            } : undefined;

            try {
                new Swiper(featuredSwiper, {
                    slidesPerView: 4,
                    spaceBetween: 22,
                    loop: slides.length > 1,
                    speed: 1200, // smooth luxury motion
                    grabCursor: true,
                    autoplay: {
                        delay: 2500,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true, // ✅ hover pause
                    },
                    navigation,
                    pagination,
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
            } catch (error) {
                console.warn('Featured products swiper failed to initialize.', error);
            }
        });
    </script>
