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
            .cart-banner h1 {
                font-size: 38px;
            }

            .cart-banner {
                height: 270px !important;
            }

            .steps-line {
                position: absolute;
                margin-left: 18px !important;
            }

            .steps-line-progress {
                position: absolute;
                left: 0px !important;

            }
        }

        /* ====================== end ==================================== */

        /* =============== cart section ===================== */
        .cart-head,
        .cart-item {
            display: grid;
            grid-template-columns: 2.5fr 1fr 1fr 1.5fr;
            align-items: center;
            gap: 15px;
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
        }

        .item-info img {
            width: 80px;
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
            /* display: block; */
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



        /* Buttons */
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
        }

        .btn-outline.danger {
            background: #FE0000;
            color: #ffffff;
        }

        /*====================== Summary card =====================*/
        .summary-card {
            background: #F5F7FF;
            padding: 25px;
            border-radius: 10px;
            width: 100%;
            max-width: 446px;
            height: 419px;
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

        @media(max-width:768px) {
            .summary-card {
                margin: 0 auto;
            }
        }

        /* ================= end ======================= */
        .checkout-steps-wrapper {
            position: relative;
            width: 100%;
            max-width: 350px;
            margin-top: 20px;
        }

        /* Base gray line (full width) */
        .steps-line {
            position: absolute;
            top: 16px;
            left: -18px;
            right: 20px;
            height: 2px;
            background: #ccc;
            z-index: 1;
        }

        /* 🔴 Progress line (only till active step) */
        .steps-line-progress {
            position: absolute;
            top: 16px;
            left: -18px;
            width: 50%;
            /* 👈 Active step tak */
            height: 2px;
            background: red;
            z-index: 2;
        }

        /* Steps row */
        .checkout-steps {
            display: flex;
            justify-content: space-around;
            position: relative;
            z-index: 3;
        }

        /* Step */
        .step {
            text-align: center;
            font-size: 12px;
        }

        /* Circle */
        .step-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #fff;
            border: 2px solid #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin: 0 auto;
        }

        /* Text */
        .step span {
            display: block;
            margin-top: 6px;
            white-space: nowrap;
        }

        /* Completed */
        .step.completed .step-circle {
            border-color: red;
            color: red;
        }

        /* Active */
        .step.active .step-circle {
            /* border-color: red; */
            color: #000000;
        }

        /*===================== checkout section  ======================= */

        .checkout-section {
            padding: 60px 0;
        }

        /* Custom Input Control */
        .form-input {
            width: 565px;
            height: 50px;
            border-radius: 4px;
        }

        form label {
            font-family: Poppins;
            font-size: 13px;
            line-height: 210%;
            font-weight: 600;

        }

        .form-check-label {
            font-family: Poppins;
            font-size: 14px;
            line-height: 20px;
            font-weight: 400;
            color: #000000;
            margin-top: 3px;
        }

        /* Mobile Fix */
        @media (max-width: 991px) {
            .form-input {
                width: 100%;
            }
        }

        .helper-text {
            color: #777;
            font-size: 14px;
            display: block;
        }

        /* Button */
        .next-btn {
            background: #0071A8;
            color: #fff;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            width: 210px;
            height: 50px;
            font-family: Poppins;
            font-size: 14px;
            line-height: 100%;
            transition: all 0.4s ease-in-out;
        }

        .next-btn:hover {
            background: #015985;
        }

        .form-divider {
            width: 100%;
            max-width: 565px;
            /* same as input */
            margin-left: 0;
            /* left aligned like inputs */
            /* border-top: px solid #5b5a5a; */
        }

        /* ORDER SUMMARY */
        .order-summary-card {
            background: #F5F7FF;
            width: 100%;
            max-width: 446px;
            height: 313px;
            padding: 20px;
            border-radius: 10px;
        }

        .order-summary-card h4 {
            font-family: Poppins;
            font-size: 24px;
            line-height: 20px;
            font-weight: 600;
            color: #000000;
        }

        .order-summary-card h6 {
            font-family: Poppins;
            font-size: 14px;
            line-height: 20px;
            font-weight: 400;
            color: #000000;
        }

        .price {
            font-family: Poppins;
            font-size: 14px;
            font-weight: 600;
            color: #000000;
            line-height: 140%;
        }

        .qty {
            font-family: Poppins;
            font-size: 14px;
            line-height: 140%;
            font-weight: 400;
            color: #A2A6B0;
        }

        .items-count {
            font-weight: 500;
            margin-bottom: 16px;
        }


        .summary-item {
            display: flex;
            gap: 12px;
            margin-top: 10px;
        }

        .summary-item img {
            width: 62px;
            height: 62px;
            object-fit: cover;
        }

        @media(max-width: 768px) {
            .order-summary-card {
                margin: 0 auto;
            }
        }

        /* ===================== end ====================================== */
    </style>
@endpush

@section('frontend-content')

    <section class="cart-banner ">

        <div class="container d-flex flex-wrap flex-md-nowrap justify-content-between">

            <h1> <span>Shipping</span> Address </h1>
            <div class="checkout-steps-wrapper">

                <!-- Base line -->
                <div class="steps-line"></div>

                <!-- Progress line -->
                <div class="steps-line-progress"></div>

                <div class="checkout-steps">

                    <!-- Step 1 -->
                    <div class="step completed">
                        <div class="step-circle">
                            <i class="fa fa-check"></i>
                        </div>
                        <span>Shipping</span>
                    </div>

                    <!-- Step 2 -->
                    <div class="step active">
                        <div class="step-circle">2</div>
                        <span>Review & Payments</span>
                    </div>

                </div>
            </div>


        </div>

    </section>


    <section class="checkout-section">
        <div class="container">
            <div class="row g-3">

                <!-- LEFT COLUMN -->
                <div class="col-lg-7">
                    <form class="shipping-form">

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email Address *</label>
                            <input type="email" class="form-control form-input">
                            <small class="helper-text mt-3">You can create an account after checkout.</small>
                        </div>
                        <hr class="form-divider my-4">
                        <!-- First Name -->
                        <div class="mb-3">
                            <label class="form-label">First Name *</label>
                            <input type="text" class="form-control form-input">
                        </div>

                        <!-- Last Name -->
                        <div class="mb-3">
                            <label class="form-label">Last Name *</label>
                            <input type="text" class="form-control form-input">
                        </div>

                        <!-- Company -->
                        <div class="mb-3">
                            <label class="form-label">Company *</label>
                            <input type="text" class="form-control form-input">
                        </div>

                        <!-- Street -->
                        <div class="mb-3">
                            <label class="form-label">Street Address *</label>
                            <input type="text" class="form-control form-input">
                            <input type="text" class="form-control form-input mt-2">

                        </div>

                        <!-- City -->
                        <div class="mb-3">
                            <label class="form-label">City *</label>
                            <input type="text" class="form-control form-input">
                        </div>

                        <!-- State -->
                        <div class="mb-3">
                            <label class="form-label">State / Province *</label>
                            <select class="form-select form-input" required>
                                <option value="">Select State / Province</option>
                                <option value="sindh">Sindh</option>
                                <option value="punjab">Punjab</option>
                                <option value="kpk">Khyber Pakhtunkhwa</option>
                                <option value="balochistan">Balochistan</option>
                                <option value="gilgit">Gilgit Baltistan</option>
                            </select>
                        </div>


                        <!-- Zip -->
                        <div class="mb-3">
                            <label class="form-label">Zip / Postal Code *</label>
                            <input type="text" class="form-control form-input">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Country *</label>
                            <select class="form-select form-input" required>
                                <option value="">Select Country</option>
                                <option value="pk">Pakistan</option>
                                <option value="us">United States</option>
                                <option value="uk">United Kingdom</option>
                                <option value="uae">United Arab Emirates</option>
                                <option value="sa">Saudi Arabia</option>
                            </select>
                        </div>
                        <!-- Phone -->
                        <div class="mb-3">
                            <label class="form-label">Phone Number *</label>
                            <input type="text" class="form-control form-input">
                        </div>

                        <hr class="mt-5">

                        <!-- SHIPPING OPTION -->

                        <div class="form-check mt-4">
                            <h5 class="mb-2">Standard Rate</h5>

                            <div class="d-flex justify-content-between align-items-start">
                                <div class="d-flex">
                                    <input class="form-check-input mt-1 me-2" type="radio" name="shipping"
                                        id="standardRate" checked>

                                    <label class="form-check-label" for="standardRate">
                                        Price may vary depending on the item/destination.
                                        Shop Staff will contact you.
                                    </label>
                                </div>

                                <p class="fw-semibold">$222</p>
                            </div>
                        </div>


                        <div class="form-check mt-4">
                            <h5 class="mb-2">Pickup from store</h5>

                            <div class="d-flex justify-content-between align-items-start">
                                <div class="d-flex">
                                    <input class="form-check-input mt-1 me-2" type="radio" name="shipping"
                                        id="standardRate" checked>

                                    <label class="form-check-label" for="standardRate">
                                        1234 Street Adress City Address, 1234
                                    </label>
                                </div>

                                <p class="fw-semibold">$222</p>
                            </div>
                        </div>


                        <!-- BUTTON -->
                        <button type="button" class="next-btn mt-4">
                            Next
                        </button>

                    </form>
                </div>


                <!-- RIGHT COLUMN -->
                <div class="col-lg-5">
                    <div class="order-summary-card">
                        <h4>Order Summary</h4>
                        <hr>

                        <p class="items-count">2 Items in Cart</p>

                        <div class="summary-item">
                            <img src="images/product.jpg" alt="">
                            <div class="">
                                <h6>Welch Allyn CP 150 ECG System</h6>

                                <div class="d-flex gap-2">
                                    <p class="qty">Qty: 1</p>
                                    <p class="price">$3,586.95</p>
                                </div>

                            </div>
                        </div>
                        <div class="summary-item">
                            <img src="images/product.jpg" alt="">
                            <div class="">
                                <h6>Welch Allyn CP 150 ECG System</h6>

                                <div class="d-flex gap-2">
                                    <p class="qty">Qty: 1</p>
                                    <p class="price">$3,586.95</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="summary-card mt-4">


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
                        <p class="small-text  mt-2">
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



                    </div>
                </div>

            </div>
        </div>
    </section>







    @push('frontend-scripts')
    @endpush
