@extends('frontend.layouts.frontend')

{{-- @section('title', 'Home') --}}
@section('meta_title', $part->meta_title ?? 'Mr. Biomed Tech Services')
@section('meta_keywords', $part->meta_keywords ?? '')
@section('meta_description', $part->meta_description ?? '')

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

        /* Star Rating */
        .rate-stars .star {
            cursor: pointer;
            transition: color 0.3s;
        }

        .rate-stars .star.selected {
            color: #FFD700;
            /* Gold color for selected stars */
        }
    </style>
@endpush

@section('frontend-content')

    @if (!$part)
        <section class="product-detail-banner">
            <h1>Parts <span>Not Found</span> </h1>
        </section>
        <div class="container py-5 text-center">
            <p class="lead">Sorry, the part you're looking for doesn't exist or has been removed.</p>
            <a href="{{ route('parts') }}" class="btn btn-primary mt-3">Back to parts</a>
        </div>
    @else
        <section class="product-detail-banner">
            <h1>{{ $part->name ?? '' }}</h1>
        </section>

        <section>

            <div class="container">
                <div class="row">
                    <div class="col-lg-6">

                        <div class="image-slider">
                            <!-- Main Image -->
                            <img id="mainImage"
                                src="{{ $part->thumbnail ?? false ? asset('storage/products/thumbnails/' . $part->thumbnail) : asset('frontend/images/offer-img.png') }}"
                                class="main-img">
                        </div>

                        <div class="thumb-slider-container">

                            <!-- Prev Button -->
                            <button class="thumb-prev">&#10094;</button>

                            <!-- Thumbnails -->
                            <div class="thumb-wrapper">
                                <div class="thumbs-track" id="thumbsTrack">
                                    {{-- Main thumbnail first --}}
                                    @if ($part->thumbnail ?? false)
                                        <img src="{{ asset('storage/products/thumbnails/' . $part->thumbnail) }}"
                                            class="thumb" onclick="thumbClicked(this.src)">
                                    @endif
                                    {{-- Then gallery images --}}
                                    @php
                                        $galleryImages = [];

                                        if (!empty($part->gallery_images ?? null)) {
                                            if (is_array($part->gallery_images)) {
                                                $galleryImages = $part->gallery_images;
                                            } else {
                                                $galleryImages = json_decode($part->gallery_images, true); // decode JSON string to array
                                            }
                                        }
                                    @endphp

                                    @if (!empty($galleryImages))
                                        @foreach ($galleryImages as $img)
                                            @if (!empty($img))
                                                <img src="{{ asset('storage/products/gallery/' . $img) }}" class="thumb"
                                                    onclick="thumbClicked(this.src)">
                                            @endif
                                        @endforeach
                                    @endif
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
                        <h2 class="product-title">{{ $part->name ?? '' }}</h2>

                        <!-- SKU / Condition / Availability -->
                        <p class="meta"><strong>SKU:</strong> {{ $part->sku ?? '' }}</p>
                        <p class="meta"><strong>CONDITION:</strong> {{ ucfirst($part->condition) }}
                        </p>
                        <p class="meta"><strong>AVAILABILITY:</strong> {{ $part->availability ?? '' }}</p>

                        <hr>

                        <!-- Price -->
                        <h3 class="product-price">${{ number_format($part->sale_price, 2) }}</h3>

                        <!-- Rating -->
                        <div class="rating mt-4">
                            @php
                                $rating = getProductRating($part);
                            @endphp

                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $rating)
                                    <i class="fa-solid fa-star"></i>
                                @else
                                    <i class="fa-regular fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <hr>

                        <!-- Options -->
                        @if (!empty($part->model))
                            <p class="options-title"><strong>OPTIONS:</strong> REQUIRED</p>
                            <ul class="my-4">
                                <li class="options-title">{{ $part->model }}</li>
                            </ul>
                        @endif

                        <hr>

                        <!-- Quantity -->
                        <div class="quantity-box" data-stock="{{ $part->stock_qty ?? 0 }}">
                            <span class="qty-btn minus">-</span>
                            <span class="qty-number">1</span>
                            <span class="qty-btn plus">+</span>
                        </div>


                        <!-- Add to Cart -->
                        <button class="add-to-cart-btn {{ !$part->in_stock ? 'disabled-btn' : '' }}"
                            data-id="{{ $part->id }}" @if (!$part->in_stock) disabled @endif>
                            {{ $part->in_stock ? 'Add to Cart' : 'Out of Stock' }}
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
                    @php
                        $words = str_word_count(strip_tags($part->description), 1); // get all words
                        $limit = 150;
                    @endphp

                    @if (count($words) > $limit)
                        <span class="short-desc">
                            {!! implode(' ', array_slice($words, 0, $limit)) !!}...
                        </span>
                        <span class="full-desc" style="display: none;">
                            {!! $part->description !!}
                        </span>

                        <!-- See More Button -->
                        <div class="tab-actions">
                            <button class="action-btn" id="seeMoreBtn">
                                <span>See More</span>
                                <i class="bi bi-chevron-down dropdown-icon"></i>
                            </button>
                        </div>
                    @else
                        {!! $part->description !!}
                    @endif
                </div>


                <!-- BROCHURES -->
                <div class="tab-content" id="brochure">
                    <div class="tab-actions">
                        <!-- Download PDF -->
                        <a href="{{ asset('storage/products/brochures/' . $part->brochures) }}" download>
                            <button class="action-btn download">
                                <span>Download PDF</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>

        </section>


    @endif
    {{-- ============= reveiw sectiion ================== --}}
    <x-testimonial-slider />

    {{-- ===================== feedback section ======================== --}}

    <section class="comment-section py-5">
        <div class="container">
            <div class="row g-4">

                <!-- ================= LEFT COLUMN ================= -->
                <div class="col-lg-6 col-md-6 fade-lef animate-card">

                    <h3 class="comment-heading mb-4">Leave a Feedback</h3>

                    <form id="feed_back_form" action="{{ route('post.product.feedback') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $part->id }}">
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control comment-input"
                                placeholder="Enter Name">
                            <span class="text-danger error-text name_error"></span>
                        </div>

                        <div class="mb-3">
                            <input type="email" name="email" class="form-control comment-input"
                                placeholder="Enter Email">
                            <span class="text-danger error-text email_error"></span>
                        </div>


                        <div class="mb-3">
                            <textarea name="message" class="form-control comment-textarea" rows="5" placeholder="Write your comment"></textarea>
                            <span class="text-danger error-text message_error"></span>
                        </div>

                        {{-- ⭐ Rating --}}
                        <div class="rate-box mb-3">
                            <h4 class="rate-title">Give The Rate!</h4>

                            <div class="rate-stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa-solid fa-star star" data-value="{{ $i }}"></i>
                                @endfor
                            </div>

                            <input type="hidden" name="rating" id="rating">
                            <span class="text-danger error-text rating_error"></span>
                        </div>

                        <div class="form-group mb-3">
                            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                            <div class="g-recaptcha w-100" data-sitekey="{{ config('services.recaptcha.sitekey') }}">
                            </div>
                            <span class="text-danger error-text g-recaptcha-response_error"></span>
                        </div>

                        <button type="submit" class="btn submitt-btn mt-4">Submit</button>
                    </form>

                </div>

                <!-- ================= RIGHT COLUMN ================= -->
                <div class="col-lg-6 col-md-6 fade-righ animate-card">

                    <h3 class="comment-heading mb-3">Feedbacks [{{ $latestReviews->count() }}]</h3>

                    <!-- Outer Box -->
                    <div class="feedback-box">

                        <!-- Inner Comment -->
                        @if ($latestReviews->isNotEmpty())
                            @foreach ($latestReviews as $review)
                                <div class="single-comment">
                                    <h5 class="comment-name">{{ $review->name }}</h5>
                                    <p class="comment-by">
                                        {{ \Illuminate\Support\Str::words($review->message, 6, '...') }}
                                    </p>
                                </div>
                            @endforeach
                        @else
                            <p>No feedbacks available.</p>
                        @endif
                    </div>

                </div>

            </div>
        </div>
    </section>

    {{-- ================= pruduct sectiion ============= --}}
    <div class="pro-section">
        <x-our-latest-products />

    </div>

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
        document.addEventListener('DOMContentLoaded', function() {

            // Quantity box logic
            document.querySelectorAll('.quantity-box').forEach(box => {
                const minusBtn = box.querySelector('.minus');
                const plusBtn = box.querySelector('.plus');
                const qtyNumber = box.querySelector('.qty-number');
                const stock = parseInt(box.dataset.stock);

                minusBtn.addEventListener('click', () => {
                    let qty = parseInt(qtyNumber.innerText);
                    if (qty > 1) qtyNumber.innerText = qty - 1;
                });

                plusBtn.addEventListener('click', () => {
                    let qty = parseInt(qtyNumber.innerText);
                    if (qty < stock) qtyNumber.innerText = qty + 1;
                });
            });

            // Add to Cart logic
            document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    if (btn.disabled) return;

                    const productId = btn.dataset.id;
                    const qtyBox = btn.closest('.col-lg-6').querySelector('.quantity-box');
                    const qty = parseInt(qtyBox.querySelector('.qty-number').innerText) || 1;

                    btn.disabled = true;
                    btn.innerText = 'Adding...';

                    fetch("/cart/add", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                product_id: productId,
                                qty: qty
                            })
                        })
                        .then(res => res.json())
                        .then(res => {
                            if (res.success) {
                                console.log('res', res);

                                btn.innerText = 'Added!';
                                toastr.success(res.message ?? 'Product added to cart!');

                                // Optional: update cart count in navbar
                                if (window.updateCartCount) window.updateCartCount(res.cart);

                                setTimeout(() => {
                                    btn.innerText = 'Add to Cart';
                                    btn.disabled = false;
                                }, 1500);
                            } else {
                                btn.innerText = 'Add to Cart';
                                btn.disabled = false;
                                toastr.error(res.message || 'Could not add to cart');
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            btn.innerText = 'Add to Cart';
                            btn.disabled = false;
                            toastr.error('Something went wrong');
                        });

                });
            });

        });


        document.addEventListener('DOMContentLoaded', function() {
            const seeMoreBtn = document.getElementById('seeMoreBtn');
            if (!seeMoreBtn) return;

            seeMoreBtn.addEventListener('click', function() {
                const tabContent = this.closest('#desc');
                tabContent.querySelector('.short-desc').style.display = 'none';
                tabContent.querySelector('.full-desc').style.display = 'inline';
                this.style.display = 'none'; // hide button after click
            });
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Star Rating Logic
            const stars = document.querySelectorAll('.rate-stars .star');
            const ratingInput = document.getElementById('rating');

            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const value = this.dataset.value;
                    ratingInput.value = value;

                    // Fill stars up to selected
                    stars.forEach(s => {
                        if (s.dataset.value <= value) {
                            s.classList.add('selected');
                        } else {
                            s.classList.remove('selected');
                        }
                    });
                });
            });

            // Feedback Form AJAX
            const feedbackForm = document.getElementById('feed_back_form');
            if (feedbackForm) {
                feedbackForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Clear previous errors
                    document.querySelectorAll('.error-text').forEach(el => el.textContent = '');

                    const formData = new FormData(feedbackForm);

                    fetch(feedbackForm.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content,
                                'Accept': 'application/json',
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                toastr.success(data.message);
                                feedbackForm.reset();
                                // Reset stars
                                stars.forEach(s => s.classList.remove('selected'));
                                ratingInput.value = '';
                                // Reset captcha
                                if (typeof grecaptcha !== 'undefined') {
                                    grecaptcha.reset();
                                }
                                // Reload page
                                location.reload();
                            } else {
                                // Handle errors
                                if (data.errors) {
                                    Object.keys(data.errors).forEach(key => {
                                        const errorEl = document.querySelector(`.${key}_error`);
                                        if (errorEl) {
                                            errorEl.textContent = data.errors[key][0];
                                        }
                                    });
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            toastr.error('Something went wrong. Please try again.');
                        });
                });
            }
        });
    </script>
@endpush
