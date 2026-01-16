@extends('frontend.layouts.frontend')

{{-- @section('title', 'Home') --}}
{{-- @section('meta_title', $data->meta_title ?? 'Mr. Biomed Tech Services')
@section('meta_keywords', $data->meta_keywords ?? '')
@section('meta_description', $data->meta_description ?? '') --}}

@push('frontend-styles')
    <style>
        /*===================== product detail banner  ============================*/
        .cart-banner {
            background: linear-gradient(90deg, #006A9E 45%, #A5CDE0);
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-top: 180px;
        }

        .cart-banner h1 {
            font-size: 50px;
            font-weight: 700;
            color: #ffffff;
            line-height: 120%;
            letter-spacing: 0;
            margin: 0;
            font-family: Arial;
        }

        .cart-banner p {
            font-size: 16px;
            font-weight: 700;
            color: #ffffff;
            line-height: 160%;
            letter-spacing: 0;
            font-family: Arial;
            max-width: 732px;
            text-align: center;
            margin: 0 auto;
        }

        .cart-banner h1 span {
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

        /* ====================== part banner ==================================== */


        .part-banner {
            background: #006A9E;
            height: 174px;
            display: flex;
            align-items: center;
            /* justify-content: center;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    text-align: center; */
            margin-top: 30px;
        }

        .part-banner h1 {
            font-size: 35px;
            font-weight: 700;
            color: #ffffff;
            line-height: 120%;
            letter-spacing: 0;
            font-family: Arial;
        }

        .part-banner p {
            font-size: 16px;
            font-weight: 700;
            color: #ffffff;
            line-height: 160%;
            letter-spacing: 0;
            font-family: Arial;
            max-width: 732px;
        }

        /* ================= end =============================== */

        /* ================= parts search section ================================== */
        .parts-search-section {
            /* padding: 40px 0; */
            margin-top: 40px;
        }

        /* Search */
        .searchh-wrapper {
            position: relative;
        }

        .search-input {
            width: 517px;
            height: 58px;
            background: #DEE9FF;
            border: none;
            border-radius: 8px;
            padding-left: 48px;
            font-size: 16px;
        }

        .search-input::placeholder {
            color: #555;
        }

        .search-input:focus {
            outline: none;
        }

        /* Search Icon */
        .search-icon {
            position: absolute;
            top: 50%;
            left: 18px;
            transform: translateY(-50%);
            color: #666;
            font-size: 18px;
        }

        /* Buttons */
        .filtter-btn {
            height: 58px;
            background: #DEE9FF;
            border: none;
            border-radius: 7px;
            font-weight: 500;
            font-family: Inter;
            font-size: 17px;
            line-height: 100%;
            width: 208px;
            color: #121212CF;
            transition: all 0.3s ease-in-out;
        }

        .filtter-btn:hover {
            background: #c0cce6;
            color: #ffffff;

        }

        .find-btn {
            height: 58px;
            background: #D43838;
            color: #FFFFFF;
            border: none;
            border-radius: 7px;
            font-weight: 600;
            font-family: Inter;
            font-size: 17px;
            line-height: 100%;
            width: 172px;
            transition: all 0.3s ease-in-out;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;

        }

        .find-btn img {
            width: 24px;
            height: 25;
            display: block;
        }

        .find-btn:hover {
            background: #ab0404;

        }

        /* Bottom text */
        .show-parts {
            font-weight: 600;
            font-family: Inter;
            font-size: 17px;
            line-height: 100%;
            color: #121212CF;
        }

        .show-parts span {
            color: #2196F3;
        }

        @media (max-width: 768px) {
            .productt-cardd img {
                width: 100%;
            }

            .productt-cardd {
                width: 100%;
            }
        }




        /* Responsive */
        @media (max-width: 768px) {
            .search-input {
                width: 605px;
            }

            .search-wrapper {
                width: 100%;
            }
        }

        @media (max-width: 767px) {
            .search-input {
                width: 330px !important;
            }


        }

        /* ======================= end ================================================ */
    </style>
@endpush

@section('frontend-content')
    <section class="cart-banner ">

        <div class="container  ">
            <h1> <span> Title For</span> Parts </h1>
            <p class="text-white mt-2">Libero diam auctor tristique hendrerit in eu vel id. Nec leo amet suscipit nulla.
                Nullam
                vitae sit tempus
                diam.</p>


        </div>

    </section>

    <section class="part-banner ">

        <div class="container  ">
            <h1> Shop By Device </h1>
            <p class="text-white mt-2">Libero diam auctor tristique hendrerit in eu vel id. Nec leo amet suscipit nulla.
                Nullam
                vitae sit tempus
                diam.</p>


        </div>

    </section>

    <section class="parts-search-section">
        <div class="container">

            <!-- Top Row -->
            <div class="d-flex  flex-wrap gap-2 justify-content-between">

                <!-- Search Input -->
                <div class="searchh-wrapper">
                    <i class="fa fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Search parts">
                </div>

                <!-- Right Buttons -->
                <div class="d-flex gap-2 flex-wrap me-4 pe-2">
                    <button class="filtter-btn">All Manufacturers</button>
                    <button class="filtter-btn">All Categories</button>
                    <button class="find-btn"> <img src="{{ asset('frontend/images/find-icon.png') }}" alt="">
                        Find</button>
                </div>

            </div>

            <!-- Bottom Text -->
            <p class="show-parts my-5">Show <span>7</span> Parts</p>

        </div>
        <div class="container mt-4">
            <div class="row g-5">
                @foreach ($parts as $item)
                    <div class="col-lg-3 col-md-6 animate-card">
                        <div class="productt-cardd">
                            <img src="{{ asset('storage/products/thumbnails/' . $item->thumbnail) }}"
                                alt="{{ $item->image_alt }}" class="img-fluid">

                            <div class="card-body p-2">
                                <div class="product-meta">
                                    <div class="stars">
                                        @php
                                            $rating = $item->rating ?? 0; // rating 0-5
                                        @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $rating)
                                                <i class="fa-solid fa-star active"></i>
                                            @else
                                                <i class="fa-solid fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>

                                    <span class="stock">In Stock</span>
                                </div>

                                <h6>{{ $item->name }}</h6>

                                <div class="price-row">
                                    @if (!empty($item->price) && $item->price > 0)
                                        <span class="old-price">${{ number_format($item->price) }}</span>
                                    @endif
                                    <span class="new-price">${{ number_format($item->sale_price) }}</span>
                                    <button class="btn-buy">Buy Now</button>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach


            </div>
        </div>
    </section>
@endsection





@push('frontend-scripts')
@endpush
