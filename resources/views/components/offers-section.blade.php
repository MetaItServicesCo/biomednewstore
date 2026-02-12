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
            <div class="offer-slider-wrapper position-relative ">

                <!-- Prev Button -->
                <button class="offer-prev"><i class="bi bi-chevron-left"></i></button>

                <!-- Slider Container -->
                <div class="offer-slider-container">
                    <div class="offer-slider-track">
                        @foreach ($p as $product)
                            <div class="offer-card">
                                <img src="{{ $product->thumbnail ? asset('storage/products/thumbnails/' . $product->thumbnail) : '' }}"
                                    alt="{{ $product->image_alt ?? $product->name }}" class="card-img img-fluid">
                                <div class="card-body border-0">
                                    <p class="card-desc">{{ $product->name }}
                                    </p>
                                    <p class="price text-danger text-center">
                                        ${{ number_format($product->sale_price, 2) }}</p>
                                    <button class="offer-readd-btn" data-id="{{ $product->id }}" data-qty="1">Add
                                        to Cart</button>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <!-- Next Button -->
                <button class="offer-next"><i class="bi bi-chevron-right"></i></button>

                <!-- Pagination -->
                <div class="offer-pagination"></div>
            </div>

        </div>
    </section>
