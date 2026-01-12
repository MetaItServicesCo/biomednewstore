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
                <div class="col-lg-3 col-md-4 product">

                    <!-- CATEGORIES -->
                    <div class="filter-main-box">
                        <h5 class="filter-main-title">CATEGORIES</h5>

                        <div class="filter-item" onclick="toggleList(this)">
                            <span>New Equipment</span>
                            <i class="fa fa-plus"></i>
                        </div>
                        <ul class="filter-list">
                            <li>Diagnostic Tools</li>
                            <li>Surgical Items</li>
                            <li>Hospital Beds</li>
                            <li>Monitors</li>
                            <li>Scanners</li>
                        </ul>
                        <div class="filter-item" onclick="toggleList(this)">
                            <span>Rental Rquipment</span>
                            <i class="fa fa-plus"></i>
                        </div>
                        <ul class="filter-list">
                            <li>Diagnostic Tools</li>
                            <li>Surgical Items</li>
                            <li>Hospital Beds</li>
                            <li>Monitors</li>
                            <li>Scanners</li>
                        </ul>
                        <div class="filter-item" onclick="toggleList(this)">
                            <span>Refurbished</span>
                            <i class="fa fa-plus"></i>
                        </div>
                        <ul class="filter-list">
                            <li>Diagnostic Tools</li>
                            <li>Surgical Items</li>
                            <li>Hospital Beds</li>
                            <li>Monitors</li>
                            <li>Scanners</li>
                        </ul>
                        <div class="filter-item" onclick="toggleList(this)">
                            <span>Equipment</span>
                            <i class="fa fa-plus"></i>
                        </div>
                        <ul class="filter-list">
                            <li>Diagnostic Tools</li>
                            <li>Surgical Items</li>
                            <li>Hospital Beds</li>
                            <li>Monitors</li>
                            <li>Scanners</li>
                        </ul>
                        <div class="filter-item" onclick="toggleList(this)">
                            <span>New Equipment</span>
                            <i class="fa fa-plus"></i>
                        </div>
                        <ul class="filter-list">
                            <li>Diagnostic Tools</li>
                            <li>Surgical Items</li>
                            <li>Hospital Beds</li>
                            <li>Monitors</li>
                            <li>Scanners</li>
                        </ul>


                        <!-- MEDICAL EQUIPMENT -->
                        <div class="filter-box">
                            <h5 class="filter-title">MEDICAL EQUIPMENT</h5>

                            <div class="filter-item" onclick="toggleList(this)">
                                <span>COVID-19 Antigen</span>
                                <i class="fa fa-plus"></i>
                            </div>
                            <ul class="filter-list">
                                <li>Test Kits</li>
                                <li>Masks</li>
                                <li>Sanitizers</li>
                                <li>Ventilators</li>
                            </ul>
                            <div class="filter-item" onclick="toggleList(this)">
                                <span>COVID-19 Antigen</span>
                                <i class="fa fa-plus"></i>
                            </div>
                            <ul class="filter-list">
                                <li>Test Kits</li>
                                <li>Masks</li>
                                <li>Sanitizers</li>
                                <li>Ventilators</li>
                            </ul>
                            <div class="filter-item" onclick="toggleList(this)">
                                <span>Thermometers</span>
                                <i class="fa fa-plus"></i>
                            </div>
                            <ul class="filter-list">
                                <li>Test Kits</li>
                                <li>Masks</li>
                                <li>Sanitizers</li>
                                <li>Ventilators</li>
                            </ul>
                            <div class="filter-item" onclick="toggleList(this)">
                                <span>Face Masks</span>
                                <i class="fa fa-plus"></i>
                            </div>
                            <ul class="filter-list">
                                <li>Test Kits</li>
                                <li>Masks</li>
                                <li>Sanitizers</li>
                                <li>Ventilators</li>
                            </ul>

                        </div>

                        <!-- PPE SUPPLIES -->
                        <div class="filter-box">
                            <h5 class="filter-title">PPE SUPPLIES</h5>

                            <div class="filter-item" onclick="toggleList(this)">
                                <span>Blood Pressure Cuffs</span>
                                <i class="fa fa-plus"></i>
                            </div>
                            <ul class="filter-list">
                                <li>Gloves</li>
                                <li>Face Shields</li>
                                <li>Masks</li>
                                <li>Gowns</li>
                                <li>Shoe Covers</li>
                                <li>Thermometers</li>
                                <li>Oximeters</li>
                            </ul>

                            <div class="filter-item" onclick="toggleList(this)">
                                <span>Blood Pressure Cuffs</span>
                                <i class="fa fa-plus"></i>
                            </div>
                            <ul class="filter-list">
                                <li>Gloves</li>
                                <li>Face Shields</li>
                                <li>Masks</li>
                                <li>Gowns</li>
                                <li>Shoe Covers</li>
                                <li>Thermometers</li>
                                <li>Oximeters</li>
                            </ul>

                            <div class="filter-item" onclick="toggleList(this)">
                                <span>Blood Pressure Cuffs</span>
                                <i class="fa fa-plus"></i>
                            </div>
                            <ul class="filter-list">
                                <li>Gloves</li>
                                <li>Face Shields</li>
                                <li>Masks</li>
                                <li>Gowns</li>
                                <li>Shoe Covers</li>
                                <li>Thermometers</li>
                                <li>Oximeters</li>
                            </ul>

                            <div class="filter-item" onclick="toggleList(this)">
                                <span>Blood Pressure Cuffs</span>
                                <i class="fa fa-plus"></i>
                            </div>
                            <ul class="filter-list">
                                <li>Gloves</li>
                                <li>Face Shields</li>
                                <li>Masks</li>
                                <li>Gowns</li>
                                <li>Shoe Covers</li>
                                <li>Thermometers</li>
                                <li>Oximeters</li>
                            </ul>
                        </div>
                    </div>





                    <!-- PRICE RANGE -->
                    <div class="filter-range-box">
                        <h5 class="filter-range-title">PRICE RANGE</h5>

                        <div class="p-3">
                            <div class="range-slider">
                                <input value="1000" min="1000" max="50000" step="500" type="range">
                                <input value="50000" min="1000" max="50000" step="500" type="range">
                                <span class="rangeValues "></span>
                                {{-- <hr> --}}
                            </div>

                            <div class="d-flex gap-2 mt-4">
                                <button class="btn btn-outline-danger w-50">Clear</button>
                                <button class="btn btn-danger w-50">Apply</button>
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
                            <div class="col-lg-5 col-md-12 col-5">
                                <img src="{{ asset('frontend/images/recent-news-img.png') }}" alt=""
                                    class="recent-pro">

                            </div>
                            <div class="col-lg-7 col-md-12 col-7">
                                <div>
                                    <h6 class="recent-title">Multivitamin B6+</h6>
                                    <p class="recent-price"> <span class="old-price">$18.00</span>
                                        <span class="new-price">$18.00</span>
                                    </p>
                                    <div class="stars">
                                        <i class="fa-solid fa-star active"></i>
                                        <i class="fa-solid fa-star active"></i>
                                        <i class="fa-solid fa-star active"></i>
                                        <i class="fa-solid fa-star active"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-12 col-5">
                                <img src="{{ asset('frontend/images/recent-news-img.png') }}" alt=""
                                    class="recent-pro">

                            </div>
                            <div class="col-lg-7 col-md-12 col-7">
                                <div>
                                    <h6 class="recent-title">Multivitamin B6+</h6>
                                    <p class="recent-price"> <span class="old-price">$18.00</span>
                                        <span class="new-price">$18.00</span>
                                    </p>
                                    <div class="stars">
                                        <i class="fa-solid fa-star active"></i>
                                        <i class="fa-solid fa-star active"></i>
                                        <i class="fa-solid fa-star active"></i>
                                        <i class="fa-solid fa-star active"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-12 col-5">
                                <img src="{{ asset('frontend/images/recent-news-img.png') }}" alt=""
                                    class="recent-pro">

                            </div>
                            <div class="col-lg-7 col-md-12 col-7">
                                <div>
                                    <h6 class="recent-title">Multivitamin B6+</h6>
                                    <p class="recent-price"> <span class="old-price">$18.00</span>
                                        <span class="new-price">$18.00</span>
                                    </p>
                                    <div class="stars">
                                        <i class="fa-solid fa-star active"></i>
                                        <i class="fa-solid fa-star active"></i>
                                        <i class="fa-solid fa-star active"></i>
                                        <i class="fa-solid fa-star active"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-12 col-5">
                                <img src="{{ asset('frontend/images/recent-news-img.png') }}" alt=""
                                    class="recent-pro">

                            </div>
                            <div class="col-lg-7 col-md-12 col-7">
                                <div>
                                    <h6 class="recent-title">Multivitamin B6+</h6>
                                    <p class="recent-price"> <span class="old-price">$18.00</span>
                                        <span class="new-price">$18.00</span>
                                    </p>
                                    <div class="stars">
                                        <i class="fa-solid fa-star active"></i>
                                        <i class="fa-solid fa-star active"></i>
                                        <i class="fa-solid fa-star active"></i>
                                        <i class="fa-solid fa-star active"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-12 col-5">
                                <img src="{{ asset('frontend/images/recent-news-img.png') }}" alt=""
                                    class="recent-pro">

                            </div>
                            <div class="col-lg-7 col-md-12 col-7">
                                <div>
                                    <h6 class="recent-title">Multivitamin B6+</h6>
                                    <p class="recent-price"> <span class="old-price">$18.00</span>
                                        <span class="new-price">$18.00</span>
                                    </p>
                                    <div class="stars">
                                        <i class="fa-solid fa-star active"></i>
                                        <i class="fa-solid fa-star active"></i>
                                        <i class="fa-solid fa-star active"></i>
                                        <i class="fa-solid fa-star active"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <!-- ================= RIGHT PRODUCTS (col-9) ================= -->
                <div class="col-lg-9 col-md-8">
                    <div class="row g-4">

                        <!-- PRODUCT CARD -->
                        <div class="col-lg-4 col-md-6 ">
                            <div class="productt-cardd">
                                <img src="{{ asset('frontend/images/recent-news-img.png') }}" alt="">

                                <div class="card-body p-2">
                                    <div class="product-meta">
                                        <div class="stars">
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <span class="stock">In Stock</span>
                                    </div>

                                    <h6>Throat Lozenges Syrup</h6>

                                    <div class="price-row">
                                        <span class="old-price">$22.00</span>
                                        <span class="new-price">$18.00</span>
                                        <button class="btn-buy">Buy Now</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- DUPLICATE FOR MORE PRODUCTS -->
                        <div class="col-lg-4 col-md-6 ">
                            <div class="productt-cardd">
                                <img src="{{ asset('frontend/images/recent-news-img.png') }}" alt="">

                                <div class="card-body p-2">
                                    <div class="product-meta">
                                        <div class="stars">
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <span class="stock">In Stock</span>
                                    </div>

                                    <h6>Throat Lozenges Syrup</h6>

                                    <div class="price-row">
                                        <span class="old-price">$22.00</span>
                                        <span class="new-price">$18.00</span>
                                        <button class="btn-buy">Buy Now</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4 col-md-6 ">
                            <div class="productt-cardd">
                                <img src="{{ asset('frontend/images/recent-news-img.png') }}" alt="">

                                <div class="card-body p-2">
                                    <div class="product-meta">
                                        <div class="stars">
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <span class="stock">In Stock</span>
                                    </div>

                                    <h6>Throat Lozenges Syrup</h6>

                                    <div class="price-row">
                                        <span class="old-price">$22.00</span>
                                        <span class="new-price">$18.00</span>
                                        <button class="btn-buy">Buy Now</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6 ">
                            <div class="productt-cardd">
                                <img src="{{ asset('frontend/images/recent-news-img.png') }}" alt="">

                                <div class="card-body p-2">
                                    <div class="product-meta">
                                        <div class="stars">
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <span class="stock">In Stock</span>
                                    </div>

                                    <h6>Throat Lozenges Syrup</h6>

                                    <div class="price-row">
                                        <span class="old-price">$22.00</span>
                                        <span class="new-price">$18.00</span>
                                        <button class="btn-buy">Buy Now</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6 ">
                            <div class="productt-cardd">
                                <img src="{{ asset('frontend/images/recent-news-img.png') }}" alt="">

                                <div class="card-body p-2">
                                    <div class="product-meta">
                                        <div class="stars">
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <span class="stock">In Stock</span>
                                    </div>

                                    <h6>Throat Lozenges Syrup</h6>

                                    <div class="price-row">
                                        <span class="old-price">$22.00</span>
                                        <span class="new-price">$18.00</span>
                                        <button class="btn-buy">Buy Now</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6 ">
                            <div class="productt-cardd">
                                <img src="{{ asset('frontend/images/recent-news-img.png') }}" alt="">

                                <div class="card-body p-2">
                                    <div class="product-meta">
                                        <div class="stars">
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <span class="stock">In Stock</span>
                                    </div>

                                    <h6>Throat Lozenges Syrup</h6>

                                    <div class="price-row">
                                        <span class="old-price">$22.00</span>
                                        <span class="new-price">$18.00</span>
                                        <button class="btn-buy">Buy Now</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6 ">
                            <div class="productt-cardd">
                                <img src="{{ asset('frontend/images/recent-news-img.png') }}" alt="">

                                <div class="card-body p-2">
                                    <div class="product-meta">
                                        <div class="stars">
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <span class="stock">In Stock</span>
                                    </div>

                                    <h6>Throat Lozenges Syrup</h6>

                                    <div class="price-row">
                                        <span class="old-price">$22.00</span>
                                        <span class="new-price">$18.00</span>
                                        <button class="btn-buy">Buy Now</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6 ">
                            <div class="productt-cardd">
                                <img src="{{ asset('frontend/images/recent-news-img.png') }}" alt="">

                                <div class="card-body p-2">
                                    <div class="product-meta">
                                        <div class="stars">
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <span class="stock">In Stock</span>
                                    </div>

                                    <h6>Throat Lozenges Syrup</h6>

                                    <div class="price-row">
                                        <span class="old-price">$22.00</span>
                                        <span class="new-price">$18.00</span>
                                        <button class="btn-buy">Buy Now</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6 ">
                            <div class="productt-cardd">
                                <img src="{{ asset('frontend/images/recent-news-img.png') }}" alt="">

                                <div class="card-body p-2">
                                    <div class="product-meta">
                                        <div class="stars">
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <span class="stock">In Stock</span>
                                    </div>

                                    <h6>Throat Lozenges Syrup</h6>

                                    <div class="price-row">
                                        <span class="old-price">$22.00</span>
                                        <span class="new-price">$18.00</span>
                                        <button class="btn-buy">Buy Now</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6 ">
                            <div class="productt-cardd">
                                <img src="{{ asset('frontend/images/recent-news-img.png') }}" alt="">

                                <div class="card-body p-2">
                                    <div class="product-meta">
                                        <div class="stars">
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <span class="stock">In Stock</span>
                                    </div>

                                    <h6>Throat Lozenges Syrup</h6>

                                    <div class="price-row">
                                        <span class="old-price">$22.00</span>
                                        <span class="new-price">$18.00</span>
                                        <button class="btn-buy">Buy Now</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6 ">
                            <div class="productt-cardd">
                                <img src="{{ asset('frontend/images/recent-news-img.png') }}" alt="">

                                <div class="card-body p-2">
                                    <div class="product-meta">
                                        <div class="stars">
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <span class="stock">In Stock</span>
                                    </div>

                                    <h6>Throat Lozenges Syrup</h6>

                                    <div class="price-row">
                                        <span class="old-price">$22.00</span>
                                        <span class="new-price">$18.00</span>
                                        <button class="btn-buy">Buy Now</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6 ">
                            <div class="productt-cardd">
                                <img src="{{ asset('frontend/images/recent-news-img.png') }}" alt="">

                                <div class="card-body p-2">
                                    <div class="product-meta">
                                        <div class="stars">
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star active"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <span class="stock">In Stock</span>
                                    </div>

                                    <h6>Throat Lozenges Syrup</h6>

                                    <div class="price-row">
                                        <span class="old-price">$22.00</span>
                                        <span class="new-price">$18.00</span>
                                        <button class="btn-buy">Buy Now</button>
                                    </div>
                                </div>
                            </div>

                        </div>



                    </div>

                </div>

            </div>
        </div>
        {{-- <section class="pagination-section py-5">

        </section> --}}

    </section>











    {{-- ================= pruduct sectiion ============= --}}
    <x-our-latest-products />

    {{-- ================faqs section ================ --}}
    {{-- <x-faq-section :faqs="$faqs" heading="Frequently Asked Questions" subheading="" subtext=""
        image="frontend/images/hero-main-img.png" :visible="4" /> --}}


@endsection

@push('frontend-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const heart = document.querySelector('.wishlist-icon');
            heart.addEventListener('click', function() {
                heart.classList.toggle('active'); // red heart toggle
            });
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

        // const range = document.getElementById('priceRange');
        // const value = document.getElementById('priceValue');

        // range.addEventListener('input', () => {
        //     value.innerText = range.value;
        // });
    </script>
    <script>
        function getVals() {
            // Get slider values
            let parent = this.parentNode;
            let slides = parent.getElementsByTagName("input");
            let slide1 = parseFloat(slides[0].value);
            let slide2 = parseFloat(slides[1].value);
            // Neither slider will clip the other, so make sure we determine which is larger
            if (slide1 > slide2) {
                let tmp = slide2;
                slide2 = slide1;
                slide1 = tmp;
            }

            let displayElement = parent.getElementsByClassName("rangeValues")[0];
            displayElement.innerHTML = "$" + slide1 + " - $" + slide2;
        }

        window.onload = function() {
            // Initialize Sliders
            let sliderSections = document.getElementsByClassName("range-slider");
            for (let x = 0; x < sliderSections.length; x++) {
                let sliders = sliderSections[x].getElementsByTagName("input");
                for (let y = 0; y < sliders.length; y++) {
                    if (sliders[y].type === "range") {
                        sliders[y].oninput = getVals;
                        // Manually trigger event first time to display values
                        sliders[y].oninput();
                    }
                }
            }
        }
    </script>
@endpush
