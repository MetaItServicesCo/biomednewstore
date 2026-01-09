@extends('frontend.layouts.frontend')

{{-- @section('title', 'Home') --}}
@section('meta_title', $data->meta_title ?? 'Mr. Biomed Tech Services')
@section('meta_keywords', $data->meta_keywords ?? '')
@section('meta_description', $data->meta_description ?? '')

@push('frontend-styles')
    <style>
        .search-wishlist-section {
            background: linear-gradient(90deg, #006A9E, #A5CDE0);
            padding: 30px 0;
            margin-top: 180px;
        }

        .search-bar input.form-control {
            border-radius: 25px;
            padding: 10px 20px;
        }

        .search-bar button {
            border-radius: 25px;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .wishlist i,
        .shop-icon i {
            cursor: pointer;
        }

        .wishlist span {
            font-size: 16px;
        }

        @media (max-width: 576px) {
            .search-bar {
                width: 100%;
                margin-top: 10px;
            }
        }
    </style>
@endpush

@section('frontend-content')
    <section class="search-wishlist-section py-5">
        <div class="container">
            <div class="row justify-content-center align-items-center g-3">

                <div class="col-12 col-md-8 d-flex align-items-center gap-2 flex-wrap">

                    <!-- Heart Icon + Wishlist -->


                    <!-- Search Input + Button -->
                    <div class="d-flex justify-content-between">

                        <div class="search-bar d-flex flex-grow-1">
                            <input type="text" class="form-control me-2" placeholder="Search products...">
                            <button class="btn btn-danger">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        <div class="wishlist d-flex align-items-center gap-2">
                            <i class="fa-regular fa-heart fa-lg text-white"></i>
                            <span class="text-white fw-bold">Add to Wishlist</span>
                        </div>
                        <!-- Shop Icon -->
                        <div class="shop-icon ms-2">
                            <i class="fa-solid fa-shop fa-lg text-white"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <section class="hero-secti py-5">


        <!-- Container Fluid with background -->

    </section>






    {{-- ================= pruduct sectiion ============= --}}
    <x-our-latest-products />

    {{-- ================faqs section ================ --}}
    {{-- <x-faq-section :faqs="$faqs" heading="Frequently Asked Questions" subheading="" subtext=""
        image="frontend/images/hero-main-img.png" :visible="4" /> --}}


@endsection

@push('frontend-scripts')
@endpush
