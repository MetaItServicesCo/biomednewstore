@extends('frontend.layouts.frontend')

{{-- @section('title', 'Home') --}}
@section('meta_title', $data->meta_title ?? 'Mr. Biomed Tech Services')
@section('meta_keywords', $data->meta_keywords ?? '')
@section('meta_description', $data->meta_description ?? '')

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
        .filter-title {
            background: #F1564F;
            color: #fff;
            padding: 10px;
            font-weight: 700;
        }

        .filter-box {
            border: 1px solid #eee;
            margin-bottom: 20px;
            padding: 10px;
        }

        .filter-item {
            display: flex;
            justify-content: space-between;
            cursor: pointer;
            padding: 8px 0;
        }

        .filter-list {
            display: none;
            list-style: none;
            padding-left: 15px;
        }

        .filter-list li {
            padding: 4px 0;
            font-size: 14px;
        }

        .apply-product {
            display: flex;
            gap: 10px;
        }

        .apply-product img {
            width: 80px;
            height: 80px;
        }

        .productt-cardd {
            width: 272px;
            height: 371px;
            border: 1px solid #0000001A;
        }

        .productt-cardd img {
            width: 272px;
            height: 256px;
        }

        .product-meta {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
        }

        .price-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .old {
            text-decoration: line-through;
            color: #888;
        }

        .new {
            font-weight: bold;
        }

        .btn-buy {
            background: #F1564F;
            color: #fff;
            border: none;
            padding: 5px 10px;
        }

        .stars {
            display: flex;
            gap: 3px;
        }

        .stars i {
            font-size: 14px;
            color: #C4C4C4;
            /* gray star */
        }

        .stars i.active {
            color: #FFC107;
            /* yellow star */
        }

        /* Product Meta */
        .product-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 6px;
        }

        .stock {
            font-size: 13px;
            color: #28a745;
            font-weight: 600;
        }

        // doesnt work funnly on firefox or edge, need to fix

        .range-slider {
            width: 300px;
            text-align: center;
            position: relative;

            .rangeValues {
                display: block;
            }
        }

        input[type=range] {
            -webkit-appearance: none;
            border: 1px solid white;
            width: 300px;
            position: absolute;
            left: 0;
        }

        input[type=range]::-webkit-slider-runnable-track {
            width: 300px;
            height: 5px;
            background: #ddd;
            border: none;
            border-radius: 3px;

        }

        input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none;
            border: none;
            height: 16px;
            width: 16px;
            border-radius: 50%;
            background: #21c1ff;
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
            width: 300px;
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
            width: 300px;
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
                        <input type="text" class="form-control me-2" placeholder="Search products...">
                        <button>
                            <i class="fa fa-search"></i>
                        </button>
                    </div>

                    <!-- Wishlist -->
                    <div class="wishlist d-flex align-items-center gap-2 pe-3 border-end">
                        <i class="fa-regular fa-heart fa-lg mt-1 wishlist-icon"></i>
                        <span class=" ">Add to Wishlist</span>
                    </div>

                    <!-- Shop Icon -->
                    <div class="shop-icon ms-1">
                        <img src="{{ asset('frontend/images/list-icon.png') }}" alt="" class="list-icon-img">
                    </div>

                </div>
            </div>
        </div>
    </section>


    <section class="product-section py-5">
        <div class="container">
            <div class="row">

                <!-- ================= LEFT SIDEBAR (col-3) ================= -->
                <div class="col-md-3">

                    <!-- CATEGORIES -->
                    <div class="filter-box">
                        <h5 class="filter-title">CATEGORIES</h5>
                        @foreach ($categories as $category)
                            <div class="filter-item" onclick="toggleList(this)">
                                <span>{{ $category->name }}</span>
                                <i class="fa fa-plus"></i>
                            </div>
                            <ul class="filter-list">
                                @if ($category->products->count())
                                    @foreach ($category->products as $product)
                                        <li>{{ $product->name }}</li>
                                    @endforeach
                                @else
                                    <li class="text-muted">No Product Found</li>
                                @endif
                            </ul>
                        @endforeach
                    </div>

                    <!-- PRICE RANGE -->
                    <div class="filter-box">
                        <h5 class="filter-title">PRICE RANGE</h5>

                        <div class="range-slider">
                            <span class="rangeValues"></span>
                            <input type="range" min="0" max="50000" step="500" value="0"
                                class="range-min">
                            <input type="range" min="0" max="50000" step="500" value="50000"
                                class="range-max">
                        </div>



                        {{-- <input type="range" min="0" max="100" value="18" id="priceRange">
                        <p class="price-value">$<span id="priceValue">18</span></p> --}}

                        <div class="d-flex gap-2">
                            <a href="{{ route('products') }}" class="btn btn-outline-danger w-50">
                                Clear
                            </a>
                            <button class="btn btn-danger w-50">Apply</button>
                        </div>
                    </div>

                    <!-- APPLY FILTER PRODUCT -->
                    <div class="filter-box">
                        <h5 class="filter-title">APPLY FILTER</h5>

                        <div class="apply-product">
                            <img src="https://via.placeholder.com/80" alt="">
                            <div>
                                <h6>Multivitamin B6+</h6>
                                <p>$18.00 <span>$18.00</span></p>
                                <div class="stars">★★★★★</div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- ================= RIGHT PRODUCTS (col-9) ================= -->
                <div class="col-md-9">
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
    {{-- <x-faq-section :faqs="$faqs" heading="Frequently Asked Questions" subheading="" subtext=""
        image="frontend/images/hero-main-img.png" :visible="4" /> --}}


@endsection

@push('frontend-scripts')
    <script>
        function getVals() {
            let parent = this.parentNode;
            let slides = parent.getElementsByTagName("input");
            let slide1 = parseFloat(slides[0].value);
            let slide2 = parseFloat(slides[1].value);

            if (slide1 > slide2) {
                let tmp = slide2;
                slide2 = slide1;
                slide1 = tmp;
            }

            let displayElement = parent.getElementsByClassName("rangeValues")[0];
            displayElement.innerHTML = "$" + slide1 + " - $" + slide2;
        }

        window.onload = function() {
            let sliderSections = document.getElementsByClassName("range-slider");
            for (let x = 0; x < sliderSections.length; x++) {
                let sliders = sliderSections[x].getElementsByTagName("input");
                for (let y = 0; y < sliders.length; y++) {
                    if (sliders[y].type === "range") {
                        sliders[y].oninput = getVals;
                        sliders[y].oninput();
                    }
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const heart = document.querySelector('.wishlist-icon');
            heart.addEventListener('click', function() {
                heart.classList.toggle('active'); // red heart toggle
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let minPrice = 0;
            let maxPrice = 50000;

            const loader = document.getElementById('productsLoader');
            const productsContainer = document.getElementById('productsContainer');
            const paginationContainer = document.getElementById('products-pagination-container');

            function showLoader() {
                loader.style.display = 'block';

                // hide old content
                productsContainer.style.display = 'none';
                paginationContainer.style.display = 'none';
            }

            function hideLoader() {
                loader.style.display = 'none';

                // show new content
                productsContainer.style.display = 'block';
                paginationContainer.style.display = 'block';
            }


            function updateSliderValues() {
                const box = document.querySelector('.range-slider');
                minPrice = Number(box.querySelector('.range-min').value);
                maxPrice = Number(box.querySelector('.range-max').value);
                box.querySelector('.rangeValues').innerText = `$${minPrice} - $${maxPrice}`;
            }

            document.querySelectorAll('.range-slider input').forEach(input => {
                input.addEventListener('input', updateSliderValues);
            });

            updateSliderValues();

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
                            page: page
                        })
                    })
                    .then(res => res.json())
                    .then(res => {
                        productsContainer.innerHTML = res.html;
                        paginationContainer.innerHTML = res.pagination;
                        bindPagination();
                    })
                    .catch(() => {
                        alert('Something went wrong');
                    })
                    .finally(() => {
                        hideLoader();
                    });
            }

            document.querySelector('.filter-box .btn-danger').addEventListener('click', function(e) {
                e.preventDefault();
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

        const range = document.getElementById('priceRange');
        const value = document.getElementById('priceValue');

        range.addEventListener('input', () => {
            value.innerText = range.value;
        });
    </script>
@endpush
