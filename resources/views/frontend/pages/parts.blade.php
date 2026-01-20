@extends('frontend.layouts.frontend')

{{-- @section('title', 'Home') --}}
@section('meta_title', 'Buy Biomedical Parts Online | Mr. Biomed Tech Services')
@section('meta_keywords', $data->meta_keywords ?? '')
@section('meta_description', 'Shop high-quality biomedical parts at Mr. Biomed Tech Services. Get the best deals on medical equipment. Contact us at +1 (469) 767-8853.')

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

        .request-parts-btn {
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
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
            color: #121212CF;
            transition: all 0.3s ease-in-out;

            /* Flex for arrow positioning */
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;

            /* Remove line-height */
            line-height: normal;
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
            <h1> <span> Parts & </span>Accessories </h1>
            <p class="text-white mt-2">Find genuine, compatible replacement parts for biomedical and medical equipment—fast,
                simple, and supported.
                Search by part name, device, manufacturer, or category. Need help? We’ll guide you.
            </p>


        </div>

    </section>

    <section class="part-banner ">

        <div class="container  ">
            <h1>Shop By Device</h1>
            <p class="text-white mt-2">Looking for a specific part? Start by selecting your device type, manufacturer, or
                category. Use the search bar to find parts by name, model, or part number—then filter results to match your
                equipment.</p>
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
                    <!-- Manufacturers Dropdown -->
                    <div class="dropdown">
                        <button class="filtter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            All Manufacturers
                        </button>
                        <div class="dropdown-menu p-3" style="min-width: 250px; max-height: 200px; overflow-y: auto;">
                            @foreach ($manufacture as $man)
                                <div class="form-check">
                                    <input class="form-check-input manufacturer-checkbox" type="checkbox"
                                        value="{{ $man }}" id="man-{{ str_replace(' ', '-', $man) }}">
                                    <label class="form-check-label" for="man-{{ str_replace(' ', '-', $man) }}">
                                        {{ $man }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Categories Dropdown -->
                    <div class="dropdown">
                        <button class="filtter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            All Categories
                        </button>
                        <div class="dropdown-menu p-3" style="min-width: 250px; max-height: 200px; overflow-y: auto;">
                            @foreach ($categories as $cat)
                                <div class="form-check">
                                    <input class="form-check-input category-checkbox" type="checkbox"
                                        value="{{ $cat->id }}" id="cat-{{ $cat->id }}">
                                    <label class="form-check-label" for="cat-{{ $cat->id }}">
                                        {{ $cat->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button class="find-btn" id="findBtn"> <img src="{{ asset('frontend/images/find-icon.png') }}"
                            alt="">
                        Find</button>

                    <!-- Reset Filter Button -->
                    <a href="{{ route('parts') }}" class="btn btn-secondary">
                        Reset Filter
                    </a>
                </div>

            </div>

            <!-- Bottom Text -->
            <p class="show-parts my-5">
                Show <span id="partsCount">{{ $totalParts }}</span> Parts
            </p>

        </div>
        <div class="container mt-4">
            {{-- Loader --}}
            <div id="partsLoader" class="text-center my-4" style="display:none;">
                <div class="spinner-border text-danger"></div>
                <p class="mt-2">Loading...</p>
            </div>

            <div class="row g-5" id="partsContainer">
                @include('partials._parts', ['parts' => $parts])
            </div>

            <div class="mt-4" id="parts-pagination-container">
                @include('vendor.pagination._pagination', ['products' => $parts])
            </div>

            <div class="mt-5 text-center">
                <a href="javascript:void(0)" id="getProposalBtn" class="btn btn-danger px-5 py-2 request-parts-btn">
                    Request Custom Parts
                </a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const loader = document.getElementById('partsLoader');
            const container = document.getElementById('partsContainer');
            const pagination = document.getElementById('parts-pagination-container');

            function showLoader() {
                loader.style.display = 'block';
                container.style.display = 'none';
                pagination.style.display = 'none';
            }

            function hideLoader() {
                loader.style.display = 'none';
                container.style.display = 'flex';
                pagination.style.display = 'block';
            }

            function fetchParts(page = 1) {
                showLoader();

                // Collect filters
                const search = document.querySelector('.search-input').value.trim();
                const manufacturers = Array.from(document.querySelectorAll('.manufacturer-checkbox:checked')).map(
                    cb => cb.value);
                const categories = Array.from(document.querySelectorAll('.category-checkbox:checked')).map(cb => cb
                    .value);

                const params = new URLSearchParams({
                    page: page,
                    search: search,
                    manufacturers: manufacturers.join(','),
                    categories: categories.join(',')
                });

                fetch('/ajax/parts/filter?' + params.toString(), {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(res => res.json())
                    .then(res => {
                        container.innerHTML = res.html;
                        pagination.innerHTML = res.pagination;

                        container.querySelectorAll('.animate-card').forEach(card => {
                            card.classList.remove('animate-card');
                        });

                        // Update the parts count dynamically
                        const partsCountElem = document.getElementById('partsCount');
                        if (partsCountElem) {
                            partsCountElem.innerText = res.totalParts;
                        }

                        bindPagination();
                    })
                    .finally(() => hideLoader());
            }

            function bindPagination() {
                document.querySelectorAll('#parts-pagination-container .page-link').forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const page = this.dataset.page;
                        if (page) fetchParts(page);
                    });
                });
            }

            // Bind find button
            document.getElementById('findBtn').addEventListener('click', function() {
                fetchParts();
            });

            // Bind search input on enter
            document.querySelector('.search-input').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    fetchParts();
                }
            });

            bindPagination();
        });
    </script>
@endpush
