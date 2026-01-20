@extends('frontend.layouts.frontend')

{{-- @section('title', 'Home') --}}
@section('meta_title', 'Buy Biomedical Equipment & Parts | Mr. Biomed Online Store')
@section('meta_keywords', $data->meta_keywords ?? '')
@section('meta_description', 'Find biomedical equipment, parts & accessories at Mr. Biomed\'s online store—affordable prices, quality products. Visit: 555 N 5th St, Garland TX.')

@push('frontend-styles')
    <style>
        .search-wishlist-section {
            background: linear-gradient(90deg, #006A9E, #A5CDE0);
            margin-top: 180px;
            height: 211px;
        }

        /* Search Bar */
        .search-bar {
            display: flex;
            flex-grow: 1;
        }

        .search-bar input.form-control {
            border-radius: 7px;
            height: 58px;
            background-color: #DEE9FF;
            max-width: 526px;
        }

        .search-bar button {
            border-radius: 4px;
            width: 70px;
            height: 58px;
            background-color: #EF1616;
            color: #ffffff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .search-bar button:hover {
            filter: brightness(1.2);
        }

        /* Wishlist */
        .wishlist {
            display: flex;
            align-items: center;
            gap: 8px;
            padding-right: 15px;
            border-right: 1px solid rgba(255, 255, 255, 0.5);
            margin-left: 80px;
            height: 40px;
            width: 170px;
        }

        .wishlist span {
            font-family: Ubuntu, sans-serif;
            font-weight: 500;
            color: #000000;
            line-height: 24px;
            letter-spacing: 0;
            font-size: 16px;
            /* max-width: 111px; */
        }

        .wishlist-icon {
            cursor: pointer;
            color: #EF1616;
            transition: transform 0.3s, color 0.3s;
            margin-right: 5px;
        }

        .wishlist-icon:hover {
            transform: scale(1.2);
        }

        .wishlist-icon.active {
            color: #a00202;
        }



        /* Shop Icon */
        .shop-icon img.list-icon-img {
            width: 38px;
            height: 36px;
            transition: all 0.3s ease;
        }

        .shop-icon img.list-icon-img:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px #ffffff70;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .search-bar {
                flex: 1 1 100%;
                margin-bottom: 10px;
            }

            .wishlist,
            .shop-icon {
                flex: 1 1 auto;
                text-align: center;
                border-right: none;
                padding-right: 0;
                margin-top: 10px;
            }
        }

        .list-wraper {
            max-width: 960px;
        }

        /* ===================== product list ===================== */
        .filter-main-title {
            background: #F1564F;
            color: #ffffff;
            padding: 18px;
            font-weight: 600;
            font-size: 24px;
            font-family: Inter;
            line-height: 100%;
            height: 58px;

            border-top-left-radius: 15px;
            border-top-right-radius: 15px;

        }

        .filter-range-title {
            background: #F1564F;
            color: #fff;
            padding: 18px;
            font-weight: 700;
            font-size: 19px;
            font-family: Inter;
            line-height: 100%;
            height: 58px;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .filter-recent-title {
            background: #F1564F;
            color: #fff;
            padding: 18px;
            font-weight: 700;
            font-size: 19px;
            font-family: Inter;
            line-height: 100%;
            height: 58px;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .filter-title {
            background: #F1564F;
            color: #fff;
            padding: 18px;
            font-weight: 700;
            font-size: 19px;
            font-family: Inter;
            line-height: 100%;
            height: 58px;


        }

        .filter-main-box {
            border: 1px solid #0000001A;
            box-shadow: 0px 1px 4px #00000040;
            border-radius: 10px;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            margin-bottom: 50px;
        }

        .filter-range-box {
            border: 1px solid #0000001A;
            box-shadow: 0px 1px 4px #00000040;
            border-radius: 10px;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            margin-bottom: 50px;
        }

        .filter-box {
            /* border: 1px solid #eee; */
            margin-bottom: 20px;
            /* padding: 10px; */

        }

        .filter-item {
            display: flex;
            justify-content: space-between;
            cursor: pointer;
            padding: 8px 12px;
        }

        .filter-item i {
            color: #0071A8;
        }

        .filter-item span {
            font-weight: 500;
            font-size: 20px;
            font-family: Inter;
            line-height: 100%;
        }

        .filter-list {
            display: none;
            list-style: none;
            padding-left: 15px;
        }

        .filter-list li {
            padding: 4px 0;
            font-weight: 400;
            font-size: 16px;
            font-family: Inter;
            line-height: 100%;
        }

        .apply-product {
            display: flex;
            gap: 10px;
        }

        .apply-product img {
            width: 80px;
            height: 80px;
        }



        /* ============== price range ========== */
        .range-slider {
            width: 100%;
            max-width: 300px;
            position: relative;
            padding-top: 25px;
            /* slider se space */
            border-bottom: 1px solid #6a6767;
        }

        .range-slider .rangeValues {
            display: block;
            margin-top: 60px;
            /* ✅ yahan margin-top kaam karega */
            font-weight: 600;
            color: #000;
            text-align: center;
        }



        input[type=range] {
            -webkit-appearance: none;
            border: 1px solid white;
            width: 100%;
            max-width: 260px;
            position: absolute;
            left: 0;
        }

        input[type=range]::-webkit-slider-runnable-track {
            width: 300px;
            height: 8px;
            background: #0071A8;
            border: none;
            border-radius: 3px;

        }

        input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none;
            border: none;
            height: 16px;
            width: 16px;
            border-radius: 50%;
            background: #000000;
            margin-top: -4px;
            cursor: pointer;
            position: relative;
            z-index: 1;
        }

        input[type=range]:focus {
            outline: none;
        }

        input[type=range]:focus::-webkit-slider-runnable-track {
            background: #ccc;
        }

        input[type=range]::-moz-range-track {
            width: 100%;
            max-width: 260px;
            height: 5px;
            background: #ddd;
            border: none;
            border-radius: 3px;
        }

        input[type=range]::-moz-range-thumb {
            border: none;
            height: 16px;
            width: 16px;
            border-radius: 50%;
            background: #21c1ff;

        }


        /*hide the outline behind the border*/

        input[type=range]:-moz-focusring {
            outline: 1px solid white;
            outline-offset: -1px;
        }

        input[type=range]::-ms-track {
            width: 100%;
            max-width: 300px;
            height: 5px;
            /*remove bg colour from the track, we'll use ms-fill-lower and ms-fill-upper instead */
            background: transparent;
            /*leave room for the larger thumb to overflow with a transparent border */
            border-color: transparent;
            border-width: 6px 0;
            /*remove default tick marks*/
            color: transparent;
            z-index: -4;

        }

        input[type=range]::-ms-fill-lower {
            background: #777;
            border-radius: 10px;
        }

        input[type=range]::-ms-fill-upper {
            background: #ddd;
            border-radius: 10px;
        }

        input[type=range]::-ms-thumb {
            border: none;
            height: 16px;
            width: 16px;
            border-radius: 50%;
            background: #21c1ff;
        }

        input[type=range]:focus::-ms-fill-lower {
            background: #888;
        }

        input[type=range]:focus::-ms-fill-upper {
            background: #ccc;
        }

        .recent-pro {
            width: 121px;
            height: 121px;
            object-fit: cover;
        }

        .recent-title {
            font-weight: 600;
            font-size: 18px;
            font-family: Inter;
            line-height: 140%;
            color: #0D0D0D;
        }

        .productt-cardd h6 {
            font-weight: 500;
            font-size: 20px;
            font-family: Inter;
            line-height: 140%;
            color: #0D0D0D;
        }

        .old-price {
            display: inline-block;
            /* important for flex/grid parents */
            text-decoration: line-through !important;
            /* override any conflicting styles */
            color: #7A7A7A;
            font-weight: 500;
            font-size: 18px;
            font-family: Inter, sans-serif;
            line-height: 160%;
            vertical-align: middle;
            /* optional for alignment with new price */
            margin-right: 8px;
            /* spacing from new price */
        }



        .new-price {
            color: #0071A8 !important;
            font-weight: 500;
            font-size: 18px;
            font-family: Inter;
            line-height: 160%;
            margin-left: 20px;
        }


        /* ====================== end ================================ */
    </style>
@endpush

@section('frontend-content')
    <section class="search-wishlist-section py-5">
        <div class="container mt-4">
            <div class="row justify-content-center align-items-center g-3">
                <div class="list-wraper d-flex align-items-center gap-3 flex-wrap mt-4">

                    <!-- Search Input + Button -->
                    <div class="search-bar d-flex gap-2">
                        <input type="text" id="searchInput" class="form-control me-2" placeholder="Search products...">
                        <button id="searchBtn">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>

                    <!-- Wishlist -->
                    <div class="wishlist d-flex align-items-center gap-2 pe-3 border-end">
                        {{-- <i class="fa-regular fa-heart fa-lg mt-1 wishlist-icon"></i>
                        <span class=" ">Add to Wishlist</span> --}}
                    </div>

                    <!-- Shop Icon -->
                    <div class="shop-icon ms-1">
                        <a href="{{ route('cart') }}" class="cart-icon-wrapper position-relative">

                            <img src="{{ asset('frontend/images/list-icon.png') }}" alt="" class="list-icon-img">
                            <span id="cart-count" class="cart-count-badge">
                                {{ count(session('cart', [])) }}
                            </span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <section class="product-section py-5">
        <div class="container">
            <div class="row">

                <!-- ================= LEFT SIDEBAR (col-3) ================= -->
                <div class="col-lg-3 col-md-4 product">

                    <!-- CATEGORIES -->
                    <div class="filter-main-box">
                        <h5 class="filter-main-title">CATEGORIES</h5>

                        @foreach ($categories as $category)
                            <div class="filter-item" onclick="toggleList(this)">
                                <span>{{ $category->name }}</span>
                                <i class="fa fa-plus"></i>
                            </div>
                            @php $prodCount = $category->products->count(); @endphp
                            <ul class="filter-list" data-cat-id="{{ $category->id }}">
                                @if ($prodCount)
                                    @foreach ($category->products as $product)
                                        <li class="mt-2 product-item" data-cat-id="{{ $category->id }}"
                                            data-index="{{ $loop->index }}"
                                            style="{{ $loop->index < 5 ? '' : 'display:none' }}">
                                            <a href="{{ route('product-detail', $product->slug) }}"
                                                class="text-decoration-none text-dark">
                                                {{ $product->name }}
                                            </a>
                                        </li>
                                    @endforeach

                                    @if ($prodCount > 5)
                                        <li class="mt-2 text-center">
                                            <button type="button" class="btn btn-link see-more-btn"
                                                data-cat-id="{{ $category->id }}" data-next="5">See more</button>
                                        </li>
                                    @endif
                                @else
                                    <li class="text-muted">No Product Found</li>
                                @endif
                            </ul>
                        @endforeach
                    </div>

                    <!-- PRICE RANGE -->
                    <div class="filter-range-box">
                        <h5 class="filter-range-title">PRICE RANGE</h5>

                        <div class="p-3">
                            <div class="range-slider">
                                <input type="range" min="0" max="50000" step="500" value="0"
                                    class="range-min">
                                <input type="range" min="0" max="50000" step="500" value="50000"
                                    class="range-max">
                                <span class="rangeValues "></span>
                                {{-- <hr> --}}
                            </div>

                            <!-- Manual Inputs -->
                            <div class="d-flex gap-2 mt-3">
                                <input type="number" id="priceFrom" class="form-control" placeholder="From">
                                <input type="number" id="priceTo" class="form-control" placeholder="To">
                            </div>

                            <div class="d-flex gap-2 mt-4">
                                <a href="{{ route('products') }}" class="btn btn-outline-danger w-50">Clear</a>
                                <button id="applyFilterBtn" class="btn btn-danger w-50">Apply</button>
                            </div>
                        </div>
                    </div>

                    <!-- APPLY FILTER PRODUCT -->
                    <div class="filter-range-box">
                        <h5 class="filter-recent-title">Recent Product</h5>
                        {{-- 
                        <div class="apply-product">

                        </div> --}}
                        <div class="row g-4 p-2">
                            @foreach ($recentProducts as $recentProduct)
                                <!-- Wrap the entire product in a link -->
                                <a href="{{ route('product-detail', $recentProduct->slug) }}"
                                    class="d-flex text-decoration-none text-dark">
                                    <div class="col-lg-5 col-md-12 col-5">
                                        <img src="{{ $recentProduct->thumbnail ? asset('storage/products/thumbnails/' . $recentProduct->thumbnail) : '' }}"
                                            alt="{{ $recentProduct->image_alt ?? $recentProduct->name }}"
                                            class="recent-pro">

                                    </div>
                                    <div class="col-lg-7 col-md-12 col-7">
                                        <div>
                                            <h6 class="recent-title">
                                                {{ \Illuminate\Support\Str::limit($recentProduct->name, 30) }}
                                            </h6>
                                            <p class="recent-price">
                                                @if ($recentProduct->price && $recentProduct->price > 0)
                                                    <span
                                                        class="old-price">${{ number_format($recentProduct->price, 2) }}</span>
                                                @endif
                                                <span
                                                    class="new-price">${{ number_format($recentProduct->sale_price, 2) }}</span>
                                            </p>
                                            <div class="stars">
                                                @php
                                                    $rating = getProductRating($recentProduct);
                                                @endphp

                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="fa-solid fa-star {{ $i <= $rating ? 'active' : '' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                </div>

                <!-- ================= RIGHT PRODUCTS (col-9) ================= -->
                <div class="col-lg-9 col-md-8">
                    <div id="productsLoader" class="text-center my-4" style="display:none;">
                        <div class="spinner-border text-danger" role="status"></div>
                        <p class="mt-2">Loading...</p>
                    </div>
                    <div id="productsContainer">
                        @include('partials._products', ['products' => $allProducts])
                    </div>

                    <div class="mt-4" id="products-pagination-container">
                        @include('vendor.pagination._pagination', ['products' => $allProducts])

                    </div>

                </div>
            </div>

        </div>

    </section>


    {{-- ================= pruduct sectiion ============= --}}
    <x-our-latest-products />

    {{-- ================faqs section ================ --}}
    <x-faq-section :faqs="$faqs" heading="Frequently Asked Questions" subheading="" subtext=""
        image="frontend/images/hero-main-img.png" :visible="4" />


@endsection

@push('frontend-scripts')
    <script>
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-buy') && e.target.disabled) {
                e.preventDefault();
            }
        });

        function getVals() {
            let parent = this.parentNode;
            let slides = parent.getElementsByTagName("input");
            let slide1 = parseFloat(slides[0].value);
            let slide2 = parseFloat(slides[1].value);

            if (slide1 > slide2)[slide1, slide2] = [slide2, slide1];

            // Clear manual inputs when slider is used
            document.getElementById('priceFrom').value = '';
            document.getElementById('priceTo').value = '';

            parent.querySelector(".rangeValues").innerHTML = "$" + slide1 + " - $" + slide2;
        }

        window.onload = function() {
            document.querySelectorAll(".range-slider input[type=range]").forEach(slider => {
                slider.oninput = getVals;
                slider.oninput();
            });
        };

        document.addEventListener('DOMContentLoaded', function() {
            const heart = document.querySelector('.wishlist-icon');
            if (heart) {
                heart.addEventListener('click', function() {
                    heart.classList.toggle('active'); // red heart toggle
                });
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let minPrice = 0;
            let maxPrice = 50000;
            let searchText = '';

            const loader = document.getElementById('productsLoader');
            const productsContainer = document.getElementById('productsContainer');
            const paginationContainer = document.getElementById('products-pagination-container');
            const searchInput = document.getElementById('searchInput');

            const rangeMin = document.querySelector('.range-min');
            const rangeMax = document.querySelector('.range-max');
            const priceFrom = document.getElementById('priceFrom');
            const priceTo = document.getElementById('priceTo');

            function showLoader() {
                loader.style.display = 'block';
                productsContainer.style.display = 'none';
                paginationContainer.style.display = 'none';
            }

            function hideLoader() {
                loader.style.display = 'none';
                productsContainer.style.display = 'block';
                paginationContainer.style.display = 'block';
            }

            function resetSlider() {
                rangeMin.value = 0;
                rangeMax.value = 50000;
                document.querySelector('.rangeValues').innerText = '$0 - $50000';
            }

            function fetchProducts(page = 1) {
                showLoader();

                fetch('/ajax/products/filter', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            min_price: minPrice,
                            max_price: maxPrice,
                            search: searchText,
                            page: page
                        })
                    })
                    .then(res => res.json())
                    .then(res => {
                        productsContainer.innerHTML = res.html;
                        paginationContainer.innerHTML = res.pagination;
                        bindPagination();
                    })
                    .finally(() => hideLoader());
            }

            // Manual input → reset slider
            priceFrom.addEventListener('input', resetSlider);
            priceTo.addEventListener('input', resetSlider);

            // 💰 APPLY FILTER
            document.getElementById('applyFilterBtn').addEventListener('click', function(e) {
                e.preventDefault();

                const fromVal = Number(priceFrom.value);
                const toVal = Number(priceTo.value);

                if (fromVal || toVal) {
                    // Manual inputs used
                    minPrice = fromVal || 0;
                    maxPrice = toVal || 50000;
                } else {
                    // Slider used
                    minPrice = Number(rangeMin.value);
                    maxPrice = Number(rangeMax.value);
                }

                fetchProducts();
            });

            function bindPagination() {
                document.querySelectorAll('#products-pagination-container .page-link').forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const page = this.dataset.page;
                        if (page) fetchProducts(page);
                    });
                });
            }

            // Search button click
            document.getElementById('searchBtn').addEventListener('click', function() {
                searchText = searchInput.value.trim();
                fetchProducts();
            });

            // Enter key in search input
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    searchText = searchInput.value.trim();
                    fetchProducts();
                }
            });

            bindPagination();
        });
    </script>

    <script>
        function toggleList(el) {
            const list = el.nextElementSibling;
            const icon = el.querySelector('i');

            list.style.display = list.style.display === 'block' ? 'none' : 'block';
            icon.classList.toggle('fa-plus');
            icon.classList.toggle('fa-minus');
        }

        // See more per-category: reveal next 5 items on each click
        document.addEventListener('click', function(e) {
            if (!e.target.classList.contains('see-more-btn')) return;

            const btn = e.target;
            const catId = btn.dataset.catId;
            let start = parseInt(btn.dataset.next, 10) || 5;
            const limit = 5;

            const items = Array.from(
                document.querySelectorAll('.product-item[data-cat-id="' + catId + '"]')
            );

            // Show ONLY next 5 hidden items
            items.forEach(item => {
                const idx = parseInt(item.dataset.index, 10);
                if (idx >= start && idx < start + limit) {
                    item.style.display = '';
                }
            });

            // Move pointer forward
            btn.dataset.next = start + limit;

            // Hide button if no more items left
            const stillHidden = items.some(item => item.style.display === 'none');
            if (!stillHidden) {
                btn.style.display = 'none';
            }
        });


        // const range = document.getElementById('priceRange');
        // const value = document.getElementById('priceValue');

        // range.addEventListener('input', () => {
        //     value.innerText = range.value;
        // });
    </script>
@endpush
