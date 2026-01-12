@extends('frontend.layouts.frontend')

{{-- @section('title', 'Home') --}}
@section('meta_title', $data->meta_title ?? 'Mr. Biomed Tech Services')
@section('meta_keywords', $data->meta_keywords ?? '')
@section('meta_description', $data->meta_description ?? '')

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

        /* ====================== end ==================================== */

        /* =============== cart section ===================== */
        .cart-head th {
            font-weight: 600;
            color: #000;
            white-space: nowrap;
        }

        .item-info {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 220px;
        }

        .item-info img {
            width: 70px;
            height: 75px;
        }

        .item-price,
        .item-subtotal {
            font-weight: 600;
            white-space: nowrap;
        }

        .item-qty {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
            background: #F5F7FF;
            width: 70px;
            height: 30px;
        }

        .qty-icons {
            display: flex;
            flex-direction: column;
            font-size: 12px;
            cursor: pointer;
        }

        .item-actions {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .item-ico {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            border: 2px solid #CACDD8;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .item-ico i {
            font-size: 12px;
            color: #A2A6B0;
        }

        .item-ico:hover {
            background: #d70e0e;
            border-color: #d70e0e;
        }

        .item-ico:hover i {
            color: #fff;
        }



        .cart-head {
            font-weight: 600;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .cart-item {
            padding: 20px 0;
        }

        .item-info {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .item-info img {
            width: 80px;
            height: 85px;
        }

        .item-price,
        .item-subtotal {
            font-weight: 600;
        }

        .item-qty {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #F5F7FF;
            display: flex;
            justify-content: center;
            align-content: center;
            width: 70px;
            height: 30px;
        }

        .qty-icons {
            display: flex;
            flex-direction: column;
            cursor: pointer;
            font-size: 12px;
        }

        .item-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 5px;
            cursor: pointer;
        }

        .item-ico {
            height: 26px;
            width: 26px;
            border-radius: 50%;
            background: #FFFFFF;
            border: 2px solid #CACDD8;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: all 0.4s ease-in-out;
        }

        .item-ico:hover,
        .item-ico i:hover {
            background: #d70e0e;
            color: #FFFFFF;
            border: none;
        }

        .item-ico i {
            color: #A2A6B0;
            font-size: 12px;
        }



        .cart-actions {
            display: flex;
            gap: 15px;
        }

        .btn-outline {
            border: none;
            background: #0071A8;
            color: #FFFFFF;
            font-weight: 600;
            width: 160px;
            height: 34px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            font-family: Poppins;
            transition: all 0.3s ease-in-out;
        }

        .btn-outline:hover {
            background: #015681;

        }

        .btn-outline.danger {
            background: #FE0000;
            color: #ffffff;
            transition: all 0.3s ease-in-out;

        }

        .btn-outline.danger:hover {
            background: #c10202;

        }

        /*====================== Summary card =====================*/
        .summary-card {
            background: #F5F7FF;
            padding: 25px;
            border-radius: 10px;
            width: 100%;
            max-width: 430px;
            height: 609px;
            margin: 0 auto;
        }

        .summary-card h5 {
            font-family: Poppins;
            font-weight: 600;
            font-size: 24px;
            line-height: 100%;
        }


        .summary-toggle {
            display: flex;
            justify-content: space-between;
            cursor: pointer;
            font-weight: 600;
        }

        .summary-toggle span {
            font-family: Poppins;
            font-weight: 400;
            font-size: 18px;
            line-height: 100%;
            color: #000000;
        }

        .summary-text {
            font-family: Poppins;
            font-weight: 400;
            font-size: 14px;
            line-height: 100%;
            color: #666666;
            margin-top: 10px;
        }

        .summary-row,
        .summary-total {
            display: flex;
            justify-content: space-between;
            font-weight: 600;
            margin: 8px 0;
        }

        .summary-total {
            font-size: 18px;
        }

        .small-text {
            display: block;
            max-width: 289px;
            font-family: Poppins;
            font-weight: 400;
            font-size: 10px;
            line-height: 1.8;
            color: #666;
            white-space: normal;
        }

        .checkout-btn {
            background: #0168A4;
            color: #fff;
            border: none;
            margin-top: 15px;
            font-weight: 600;
            border-radius: 50px;
            width: 100%;
            max-width: 372.1524658203125px;
            height: 48.607242584228516px;
            transition: all 0.4s ease-in-out;

        }

        .checkout-btn:hover {
            transform: scale(1.04)
        }

        .paypal-btn {
            background: transparent;
            border: none;
            margin-top: 10px;

            display: flex;
            align-items: center;
            justify-content: center;

            width: 100%;
            max-width: 372px;
            height: 49px;

            cursor: pointer;
            transition: all 0.4s ease-in-out;
        }

        .paypal-btn:hover {
            transform: scale(1.04)
        }

        /* PayPal Logo */
        .paypal-btn img {
            width: 370px;
            max-width: 120%;
            height: 49px;
        }

        /* ================= end ======================= */
    </style>
@endpush

@section('frontend-content')

    <section class="cart-banner">
        <h1>Shopping <span>Cart</span> </h1>
    </section>




    <section>

        <section class="cart-section py-5">
            <div class="container">
                <div class="row g-4">

                    <!-- ================= LEFT CART COLUMN ================= -->
                    {{-- <div class="col-lg-8">

                        <div class="cart-head">
                            <span>Item</span>
                            <span>Price</span>
                            <span>Qty</span>
                            <span>Subtotal</span>
                        </div>

                        <div class="cart-item">
                            <div class="item-info">
                                <img src="{{ asset('frontend/images/offer-img.png') }}" alt="">
                                <p>Welch Allyn CP 150 ECG System</p>
                            </div>

                            <div class="item-price">$3,586.95</div>

                            <div class="item-qty">
                                <span class="qty-number">1</span>
                                <div class="qty-icons">
                                    <i class="fa fa-chevron-up"></i>
                                    <i class="fa fa-chevron-down"></i>
                                </div>
                            </div>

                            <div class="item-subtotal">
                                <div class="d-flex gap-4">
                                    <p>$3,586.95</p>
                                    <div class="item-actions">
                                        <div class="item-ico">
                                            <i class="fa-solid fa-xmark"></i>

                                        </div>
                                        <div class="item-ico">
                                            <i class="fa fa-pen"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>


                        <!-- Cart Item -->
                        <div class="cart-item">
                            <!-- Item -->
                            <div class="item-info">
                                <img src="{{ asset('frontend/images/offer-img.png') }}" alt="">
                                <p>Welch Allyn CP 150 ECG System</p>
                            </div>

                            <!-- Price -->
                            <div class="item-price">$3,586.95</div>

                            <!-- Quantity -->
                            <div class="item-qty">
                                <span class="qty-number">1</span>
                                <div class="qty-icons">
                                    <i class="fa fa-chevron-up"></i>
                                    <i class="fa fa-chevron-down"></i>
                                </div>
                            </div>

                            <!-- Subtotal -->
                            <div class="item-subtotal">
                                <div class="d-flex gap-4">
                                    <p>$3,586.95</p>
                                    <div class="item-actions">
                                        <div class="item-ico">
                                            <i class="fa-solid fa-xmark"></i>

                                        </div>
                                        <div class="item-ico">
                                            <i class="fa fa-pen"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <!-- Cart Buttons -->
                        <div class="cart-actions">
                            <button class="btn-outline">Continue Shopping</button>
                            <button class="btn-outline danger">Clear Shopping Cart</button>
                        </div>
                    </div> --}}
                    <div class="col-lg-8">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle cart-table ">

                                <!-- Head -->
                                <thead class="cart-head">
                                    <tr>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>

                                <!-- Body -->
                                <tbody>

                                    <!-- Item Row -->
                                    <tr class="border-bottom">
                                        <!-- Item -->
                                        <td>
                                            <div class="item-info">
                                                <img src="{{ asset('frontend/images/offer-img.png') }}" alt="">
                                                <p class="mt-3">Welch Allyn CP 150 ECG System</p>
                                            </div>
                                        </td>

                                        <!-- Price -->
                                        <td class="item-price">$3,586.95</td>

                                        <!-- Qty -->
                                        <td>
                                            <div class="item-qty">
                                                <span>1</span>
                                                <div class="qty-icons">
                                                    <i class="fa fa-chevron-up"></i>
                                                    <i class="fa fa-chevron-down"></i>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Subtotal -->
                                        <td class="item-subtotal">
                                            <div
                                                class="d-flex gap-3 align-items-start justify-content-center align-items-center">
                                                <p class="mt-3">$3,586.95</p>
                                                <div class="item-actions">
                                                    <div class="item-ico"><i class="fa-solid fa-xmark"></i></div>
                                                    <div class="item-ico"><i class="fa fa-pen"></i></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <!-- Item -->
                                        <td>
                                            <div class="item-info">
                                                <img src="{{ asset('frontend/images/offer-img.png') }}" alt="">
                                                <p class="mt-3">Welch Allyn CP 150 ECG System</p>
                                            </div>
                                        </td>

                                        <!-- Price -->
                                        <td class="item-price">$3,586.95</td>

                                        <!-- Qty -->
                                        <td>
                                            <div class="item-qty">
                                                <span>1</span>
                                                <div class="qty-icons">
                                                    <i class="fa fa-chevron-up"></i>
                                                    <i class="fa fa-chevron-down"></i>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Subtotal -->
                                        <td class="item-subtotal">
                                            <div
                                                class="d-flex gap-3 align-items-start justify-content-center align-items-center">
                                                <p class="mt-3">$3,586.95</p>
                                                <div class="item-actions">
                                                    <div class="item-ico"><i class="fa-solid fa-xmark"></i></div>
                                                    <div class="item-ico"><i class="fa fa-pen"></i></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                </tbody>



                            </table>
                        </div>

                        <!-- Buttons -->
                        <div class="cart-actions mt-3">
                            <button class="btn-outline">Continue Shopping</button>
                            <button class="btn-outline danger">Clear Shopping Cart</button>
                        </div>
                    </div>


                    <!-- ================= RIGHT SUMMARY COLUMN ================= -->
                    <div class="col-lg-4">
                        <div class="summary-card">

                            <h5>Summary</h5>

                            <div class="summary-toggle mt-3">
                                <span>Estimate Shipping and Tax</span>
                                <i class="fa fa-chevron-down"></i>
                            </div>
                            <p class="summary-text  mt-3">
                                Enter your destination to get a shipping estimate.
                            </p>

                            <div class="summary-toggle  mt-3">
                                <span>Apply Discount Code</span>
                                <i class="fa fa-chevron-down"></i>
                            </div>

                            <hr>

                            <div class="summary-row mt-3">
                                <span>Subtotal</span>
                                <span>$3,586.95</span>
                            </div>

                            <div class="summary-row  mt-3">
                                <span>Shipping</span>
                                <span>$40.00</span>
                            </div>
                            <p class="small-text  mt-3">
                                (Standard Rate - Price may vary depending on the item/destination. TECS Staff will contact
                                you.)
                            </p>

                            <div class="summary-row  mt-3">
                                <span>Tax</span>
                                <span>10%</span>
                            </div>
                            <div class="summary-row  mt-3">
                                <span>GST (10%)</span>
                                <span>10%</span>
                            </div>
                            <div class="summary-total  mt-3">
                                <span>Order Total</span>
                                <span>$3,982.64</span>
                            </div>

                            <button class="checkout-btn  mt-3">Proceed to Checkout</button>

                            <button class="paypal-btn  mt-3">
                                <img src="{{ asset('frontend/images/paypal-logo.png') }}" alt="PayPal">
                            </button>

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
    @endpush
