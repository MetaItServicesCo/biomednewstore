@extends('frontend.layouts.frontend')

{{-- @section('title', 'Home') --}}

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

        /* ================ PAYMENT MODAL ================== */
        .payment-modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 99999;
            align-items: center;
            justify-content: center;
        }

        .payment-modal-overlay.show {
            display: flex;
        }

        .payment-modal {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 500px;
            padding: 40px;
            position: relative;
            animation: slideUp 0.3s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .payment-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }

        .payment-modal-header h2 {
            font-family: Poppins;
            font-size: 28px;
            font-weight: 700;
            color: #000;
            margin: 0;
        }

        .payment-modal-close {
            width: 35px;
            height: 35px;
            background: #f5f5f5;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #666;
            transition: all 0.3s ease;
        }

        .payment-modal-close:hover {
            background: #e74c3c;
            color: white;
        }

        .payment-info-section {
            margin-bottom: 30px;
        }

        .payment-info-section label {
            font-family: Poppins;
            font-size: 13px;
            font-weight: 600;
            color: #000;
            margin-bottom: 10px;
            display: block;
        }

        #card-element {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            height: 45px;
            background: #fafafa;
            transition: border-color 0.3s ease;
        }

        #card-element:focus {
            border-color: #0071A8;
            box-shadow: 0 0 0 3px rgba(0, 113, 168, 0.1);
        }

        #card-errors {
            color: #e74c3c;
            margin-top: 12px;
            font-size: 14px;
            font-weight: 500;
            display: none;
        }

        #card-errors.show {
            display: block;
        }

        .payment-amount {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            border-radius: 10px;
            margin: 25px 0;
            color: white;
            text-align: center;
        }

        .payment-amount-label {
            font-size: 13px;
            font-weight: 500;
            opacity: 0.9;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .payment-amount-value {
            font-size: 32px;
            font-weight: 700;
            font-family: Poppins;
        }

        .payment-modal-footer {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .payment-modal-footer button {
            flex: 1;
            padding: 14px 20px;
            border: none;
            border-radius: 50px;
            font-family: Poppins;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-cancel {
            background: #f5f5f5;
            color: #666;
        }

        .btn-cancel:hover {
            background: #e0e0e0;
            color: #333;
        }

        .btn-pay {
            background: linear-gradient(135deg, #0071A8 0%, #005380 100%);
            color: white;
        }

        .btn-pay:hover {
            background: linear-gradient(135deg, #005380 0%, #003d5c 100%);
            box-shadow: 0 5px 20px rgba(0, 113, 168, 0.3);
            transform: translateY(-2px);
        }

        .btn-pay:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .security-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }

        .security-badge i {
            color: #27ae60;
            font-size: 16px;
        }

        @media (max-width: 768px) {
            .payment-modal {
                width: 95%;
                padding: 30px 20px;
            }

            .payment-modal-header h2 {
                font-size: 24px;
            }

            .payment-amount-value {
                font-size: 28px;
            }
        }

        /* ================ END PAYMENT MODAL ================== */
@endpush

@section('frontend-content')
    @php
        $cart = session('cart', []);
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['qty'];
        }

        // Dynamic shipping based on selected method
        $selectedShippingMethod = old('shipping_method', 'standard');
        $shipping = ($selectedShippingMethod === 'pickup') ? 0.0 : 40.0;

        $gst_percent = 8.25 / 100; // 8.25%
        $gst = $subtotal * $gst_percent;
        $total = $subtotal + $shipping + $gst;
    @endphp
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
                    <form class="shipping-form" id="shipping_form" action="{{route('order.save')}}" method="POST">
                        @csrf
                        <!-- Hidden cart data -->
                        <input type="hidden" name="cart" id="cart_data" value="{{ json_encode($cart) }}">
                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email Address *</label>
                            <input type="email" class="form-control form-input" id="email" name="email" value="{{ old('email') }}" required>
                            <div class="text-danger error-message" id="email_error"></div>
                            <small class="helper-text mt-3">You can create an account after checkout.</small>
                        </div>
                        <hr class="form-divider my-4">
                        <!-- First Name -->
                        <div class="mb-3">
                            <label class="form-label">First Name *</label>
                            <input type="text" class="form-control form-input" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                            <div class="text-danger error-message" id="first_name_error"></div>
                        </div>

                        <!-- Last Name -->
                        <div class="mb-3">
                            <label class="form-label">Last Name *</label>
                            <input type="text" class="form-control form-input" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                            <div class="text-danger error-message" id="last_name_error"></div>
                        </div>

                        <!-- Company -->
                        <div class="mb-3">
                            <label class="form-label">Company</label>
                            <input type="text" class="form-control form-input" id="company" name="company" value="{{ old('company') }}">
                            <div class="text-danger error-message" id="company_error"></div>
                        </div>

                        <!-- Street -->
                        <div class="mb-3">
                            <label class="form-label">Street Address *</label>
                            <input type="text" class="form-control form-input" placeholder="Address" id="street_address" name="street_address" value="{{ old('street_address') }}" required>
                            <div class="text-danger error-message" id="street_address_error"></div>
                            <input type="text" class="form-control form-input mt-2" placeholder="Address (Optional)" id="street_address_2" name="street_address_2" value="{{ old('street_address_2') }}">
                            <div class="text-danger error-message" id="street_address_2_error"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Country *</label>
                            <select class="form-select form-input" id="country_id" name="country_id" required>
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" data-code="{{ $country->iso2 }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger error-message" id="country_id_error"></div>
                        </div>

                        <!-- State -->
                        <div class="mb-3">
                            <label class="form-label" id="state_label">State / Province</label>
                            <select class="form-select form-input" id="state_id" name="state_id">
                                <option value="">Select State / Province</option>
                            </select>
                            <div class="text-danger error-message" id="state_id_error"></div>
                        </div>

                        <!-- City -->
                        <div class="mb-3">
                            <label class="form-label" id="city_label">City</label>
                            <select class="form-select form-input" id="city_id" name="city_id">
                                <option value="">Select City</option>
                            </select>
                            <div class="text-danger error-message" id="city_id_error"></div>
                        </div>


                        <!-- Zip -->
                        <div class="mb-3">
                            <label class="form-label">Zip / Postal Code *</label>
                            <input type="text" class="form-control form-input" id="postal_code" name="postal_code" value="{{ old('postal_code') }}" required>
                            <div class="text-danger error-message" id="postal_code_error"></div>
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label class="form-label">Phone Number *</label>
                            <input type="text" class="form-control form-input" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
                            <div class="text-danger error-message" id="phone_number_error"></div>
                        </div>

                        <hr class="mt-5">

                        <!-- SHIPPING OPTION -->

                        <div class="form-check mt-4">
                            <h5 class="mb-2">Standard Rate</h5>

                            <div class="d-flex justify-content-between align-items-start">
                                <div class="d-flex">
                                    <input class="form-check-input mt-1 me-2" type="radio" name="shipping_method"
                                        id="standardRate" value="standard" {{ old('shipping_method', 'standard') === 'standard' ? 'checked' : '' }}>

                                    <label class="form-check-label" for="standardRate">
                                        Price may vary depending on the item/destination.
                                        Shop Staff will contact you.
                                    </label>
                                </div>

                                <p class="fw-semibold">${{ number_format($total, 2) }}</p>
                            </div>
                        </div>


                        <div class="form-check mt-4">
                            <h5 class="mb-2">Pickup from store</h5>

                            <div class="d-flex justify-content-between align-items-start">
                                <div class="d-flex">
                                    <input class="form-check-input mt-1 me-2" type="radio" name="shipping_method"
                                        id="pickup" value="pickup" {{ old('shipping_method') === 'pickup' ? 'checked' : '' }}>

                                    <label class="form-check-label" for="pickup">
                                        1234 Street Adress City Address, 1234
                                    </label>
                                </div>

                                <p class="fw-semibold">$0.00</p>
                            </div>
                        </div>


                        <!-- PAYMENT METHOD MODAL -->

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

                        <p class="items-count">{{ count($cart) }} {{ count($cart) == 1 ? 'Item' : 'Items' }} in Cart</p>

                        @forelse($cart as $item)
                            @php
                                $itemSubtotal = ($item['price'] ?? 0) * ($item['qty'] ?? 1);
                                $itemImage =
                                    isset($item['image']) && !empty($item['image'])
                                        ? asset('storage/products/thumbnails/' . $item['image'])
                                        : asset('frontend/images/offer-img.png');
                                $itemName = $item['name'] ?? 'Product';
                                $itemQty = $item['qty'] ?? 0;
                            @endphp
                            <div class="summary-item">
                                <img src="{{ $itemImage }}" alt="{{ $itemName }}">
                                <div class="">
                                    <h6>{{ $itemName }}</h6>

                                    <div class="d-flex gap-2">
                                        <p class="qty">Qty: {{ $itemQty }}</p>
                                        <p class="price">${{ number_format($itemSubtotal, 2) }}</p>
                                    </div>

                                </div>
                            </div>
                        @empty
                            <p class="text-center text-muted">No items in cart</p>
                        @endforelse
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
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>

                        <div class="summary-row mt-3 shipping-row" id="shippingRow">
                            <span>Shipping</span>
                            <span id="shippingAmount">${{ number_format($shipping, 2) }}</span>
                        </div>
                        <p class="small-text mt-2 shipping-note" id="shippingNote">
                            (Standard Rate - Price may vary depending on the item/destination. TECS Staff will contact
                            you.)
                        </p>

                        <div class="summary-row  mt-3">
                            <span>GST (8.25%)</span>
                            <span>${{ number_format($gst, 2) }}</span>
                        </div>
                        <div class="summary-total  mt-3">
                            <span>Order Total</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- PAYMENT MODAL -->
    <div id="paymentModal" class="payment-modal-overlay">
        <div class="payment-modal">
            <div class="payment-modal-header">
                <h2>💳 Payment Details</h2>
                <button type="button" class="payment-modal-close" id="closePaymentModal">
                    <i class="fa fa-times"></i>
                </button>
            </div>

            <div class="payment-amount">
                <div class="payment-amount-label">Total Amount Due</div>
                <div class="payment-amount-value" id="modalTotalAmount">${{ number_format($total, 2) }}</div>
            </div>

            <div class="payment-info-section">
                <label for="card-element">Card Information</label>
                <div id="card-element"></div>
                <div id="card-errors"></div>
            </div>

            <div class="payment-info-section">
                <div style="font-size: 12px; color: #999; padding: 10px; background: #f9f9f9; border-radius: 6px;">
                    <i class="fa fa-info-circle"></i> Your payment is secure and encrypted
                </div>
            </div>

            <div class="payment-modal-footer">
                <button type="button" class="payment-modal-footer button btn-cancel" id="cancelPaymentModal">
                    Cancel
                </button>
                <button type="button" class="payment-modal-footer button btn-pay" id="confirmPaymentBtn">
                    Pay Now
                </button>
            </div>

            <div class="security-badge">
                <i class="fa fa-lock"></i>
                Secured by Stripe
            </div>
        </div>
    </div>
@endsection

@push('frontend-scripts')
    <!-- Stripe JS -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        $(document).ready(function() {
            console.log('Script loaded and document ready');

            // Check if Stripe key is available
            const stripeKey = '{{ config("services.stripe.key") }}';
            console.log('Stripe key:', stripeKey);
            if (!stripeKey || stripeKey.trim() === '') {
                alert('Stripe public key is not configured. Please check your .env file.');
                return;
            }

            // Initialize Stripe
            const stripe = Stripe(stripeKey);
            const elements = stripe.elements();

            // Create card element
            const cardElement = elements.create('card');
            cardElement.mount('#card-element');

            // Handle card errors
            cardElement.on('change', function(event) {
                const displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                    displayError.classList.add('show');
                } else {
                    displayError.textContent = '';
                    displayError.classList.remove('show');
                }
            });

            const stateSelect = $('#state_id');
            const citySelect = $('#city_id');

            const stateLabel = $('#state_label');
            const cityLabel = $('#city_label');

            // =====================
            // Reset functions
            // =====================
            function resetState() {
                stateSelect.empty().append('<option value="">Select State / Province</option>');
                stateSelect.prop('required', false);
                stateLabel.text('State / Province');
            }

            function resetCity() {
                citySelect.empty().append('<option value="">Select City</option>');
                citySelect.prop('required', false);
                cityLabel.text('City');
            }

            // =====================
            // Country Change
            // =====================
            $('#country_id').on('change', function() {

                let countryId = $(this).val();
                                
                resetState();
                resetCity();

                if (!countryId) return;

                $.ajax({
                    url: "{{ route('get.states', ':id') }}".replace(':id', countryId),
                    type: 'GET',
                    success: function(response) {

                        resetState();

                        if (response.success && response.states.length > 0) {

                            $.each(response.states, function(key, state) {
                                stateSelect.append(
                                    `<option value="${state.id}">${state.name}</option>`
                                );
                            });

                            stateSelect.prop('required', true);
                            stateLabel.text('State / Province *');

                        } else {
                            stateSelect.append('<option value="">No State Found</option>');
                            stateSelect.prop('required', false);
                            stateLabel.text('State / Province');
                        }
                    },
                    error: function() {
                        resetState();
                        stateSelect.append('<option value="">No State Found</option>');
                    }
                });
            });

            // =====================
            // State Change
            // =====================
            $('#state_id').on('change', function() {

                let stateId = $(this).val();

                resetCity();

                if (!stateId) return;

                $.ajax({
                    url: "{{ route('get.cities', ':id') }}".replace(':id', stateId),
                    type: 'GET',
                    success: function(response) {

                        resetCity();

                        if (response.success && response.cities.length > 0) {

                            $.each(response.cities, function(key, city) {
                                citySelect.append(
                                    `<option value="${city.id}">${city.name}</option>`
                                );
                            });

                            citySelect.prop('required', true);
                            cityLabel.text('City *');

                        } else {
                            citySelect.append('<option value="">No Cities Found</option>');
                            citySelect.prop('required', false);
                            cityLabel.text('City');
                        }
                    },
                    error: function() {
                        resetCity();
                        citySelect.append('<option value="">No Cities Found</option>');
                    }
                });
            });

            // =====================
            // Form Validation
            // =====================
            function validateForm() {
                console.log('Starting validation');
                let isValid = true;
                const errors = {};

                // Clear previous errors
                $('.error-message').text('');

                // Email validation
                const email = $('#email').val().trim();
                if (!email) {
                    errors.email = 'Email is required';
                    isValid = false;
                } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    errors.email = 'Please enter a valid email address';
                    isValid = false;
                }

                // First name validation
                const firstName = $('#first_name').val().trim();
                if (!firstName) {
                    errors.first_name = 'First name is required';
                    isValid = false;
                }

                // Last name validation
                const lastName = $('#last_name').val().trim();
                if (!lastName) {
                    errors.last_name = 'Last name is required';
                    isValid = false;
                }

                // Street address validation
                const streetAddress = $('#street_address').val().trim();
                if (!streetAddress) {
                    errors.street_address = 'Street address is required';
                    isValid = false;
                }

                // Country validation
                const countryId = $('#country_id').val();
                if (!countryId) {
                    errors.country_id = 'Country is required';
                    isValid = false;
                }

                // State validation (if required)
                if (stateSelect.prop('required')) {
                    const stateId = $('#state_id').val();
                    if (!stateId) {
                        errors.state_id = 'State/Province is required';
                        isValid = false;
                    }
                }

                // City validation (if required)
                if (citySelect.prop('required')) {
                    const cityId = $('#city_id').val();
                    if (!cityId) {
                        errors.city_id = 'City is required';
                        isValid = false;
                    }
                }

                // Postal code validation
                const postalCode = $('#postal_code').val().trim();
                if (!postalCode) {
                    errors.postal_code = 'Postal code is required';
                    isValid = false;
                }

                // Phone validation
                const phoneNumber = $('#phone_number').val().trim();
                if (!phoneNumber) {
                    errors.phone_number = 'Phone number is required';
                    isValid = false;
                }

                // Display errors
                Object.keys(errors).forEach(field => {
                    $(`#${field}_error`).text(errors[field]);
                });

                console.log('Validation complete. Is valid: ' + isValid + '. Errors: ' + JSON.stringify(errors));
                return isValid;
            }

            // =====================
            // Next Button Click
            // =====================
            $('.next-btn').on('click', function() {
                console.log('Next button clicked');
                if (!validateForm()) {
                    console.log('Validation failed');
                    return;
                }
                console.log('Validation passed, showing payment modal');

                // Show payment modal
                $('#paymentModal').addClass('show');

                // Ensure Stripe elements are properly mounted after modal is shown
                setTimeout(function() {
                    try {
                        // Check if element is already mounted, if not, mount it
                        if (cardElement._implementation && cardElement._implementation._mounted) {
                            // Already mounted, no need to do anything
                            console.log('Card element already mounted');
                        } else {
                            // Mount the card element
                            cardElement.mount('#card-element');
                            console.log('Card element mounted');
                        }
                    } catch (error) {
                        console.log('Stripe element mounting:', error);
                        // Fallback: just try to mount
                        try {
                            cardElement.mount('#card-element');
                        } catch (mountError) {
                            console.log('Mount fallback failed:', mountError);
                        }
                    }
                }, 200);
            });

            // =====================
            // Close Payment Modal
            // =====================
            function closePaymentModal() {
                $('#paymentModal').removeClass('show');

                // Clear payment information
                try {
                    // Clear card element
                    cardElement.clear();

                    // Clear any error messages
                    const displayError = document.getElementById('card-errors');
                    displayError.textContent = '';
                    displayError.classList.remove('show');

                    // Reset modal total amount to current calculation
                    const selectedMethod = $('input[name="shipping_method"]:checked').val();
                    const subtotal = {{ $subtotal }};
                    const gst = {{ $gst }};
                    let shipping = 0;
                    let total = 0;

                    if (selectedMethod === 'standard') {
                        shipping = 40.0;
                    } else if (selectedMethod === 'pickup') {
                        shipping = 0.0;
                    }

                    total = subtotal + shipping + gst;
                    $('#modalTotalAmount').text('$' + total.toFixed(2));

                } catch (error) {
                    console.log('Error clearing payment info:', error);
                }
            }

            $('#closePaymentModal, #cancelPaymentModal').on('click', function() {
                closePaymentModal();
            });

            // Close modal when clicking outside
            $('#paymentModal').on('click', function(e) {
                if (e.target.id === 'paymentModal') {
                    closePaymentModal();
                }
            });

            // =====================
            // Shipping Method Change
            // =====================
            $('input[name="shipping_method"]').on('change', function() {
                const selectedMethod = $(this).val();
                const subtotal = {{ $subtotal }};
                const gst = {{ $gst }};
                let shipping = 0;
                let total = 0;

                if (selectedMethod === 'standard') {
                    shipping = 40.0;
                    $('#shippingRow').show();
                    $('#shippingNote').show();
                    $('#shippingAmount').text('$' + shipping.toFixed(2));
                } else if (selectedMethod === 'pickup') {
                    shipping = 0.0;
                    $('#shippingRow').hide();
                    $('#shippingNote').hide();
                }

                // Update total calculation
                total = subtotal + shipping + gst;

                // Update the total display
                $('.summary-total span:last-child').text('$' + total.toFixed(2));

                // Update the shipping option display
                $('.form-check .fw-semibold').each(function() {
                    const method = $(this).closest('.form-check').find('input[type="radio"]').val();
                    if (method === 'standard') {
                        $(this).text('$' + total.toFixed(2));
                    } else if (method === 'pickup') {
                        $(this).text('$0.00');
                    }
                });

                // Update modal total amount
                $('#modalTotalAmount').text('$' + total.toFixed(2));
            });

            // Trigger initial shipping method check
            $('input[name="shipping_method"]:checked').trigger('change');

            // =====================
            // Pay Now Button Click
            // =====================
            $('#confirmPaymentBtn').on('click', function() {
                processPayment();
            });

            // =====================
            // Process Payment
            // =====================
            function processPayment() {
                // Show loading on button
                $('#confirmPaymentBtn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');

                // Get form data
                const formData = new FormData(document.getElementById('shipping_form'));

                // Convert FormData to JSON
                const data = {};
                for (let [key, value] of formData.entries()) {
                    data[key] = value;
                }

                // Add cart data
                data.cart = JSON.parse($('#cart_data').val());

                // Create payment intent directly (no order creation yet)
                createPaymentIntent(data);
            }

            // =====================
            // Create Payment Intent
            // =====================
            function createPaymentIntent(formData) {
                $.ajax({
                    url: "{{ route('order.payment-intent') }}",
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            // Confirm card payment
                            stripe.confirmCardPayment(response.client_secret, {
                                payment_method: {
                                    card: cardElement,
                                    billing_details: {
                                        name: $('#first_name').val() + ' ' + $('#last_name').val(),
                                        email: $('#email').val(),
                                        phone: $('#phone_number').val(),
                                        address: {
                                            line1: $('#street_address').val(),
                                            line2: $('#street_address_2').val(),
                                            city: $('#city_id option:selected').text(),
                                            state: $('#state_id option:selected').text(),
                                            postal_code: $('#postal_code').val(),
                                            country: $('#country_id option:selected').data('code'),
                                        }
                                    }
                                }
                            }).then(function(result) {
                                if (result.error) {
                                    // Payment failed
                                    const displayError = document.getElementById('card-errors');
                                    displayError.textContent = result.error.message;
                                    displayError.classList.add('show');
                                    $('#confirmPaymentBtn').prop('disabled', false).text('Pay Now');
                                } else {
                                    if (result.paymentIntent.status === 'succeeded') {
                                        // Payment successful, confirm payment and create order
                                        confirmPayment(result.paymentIntent.id, formData);
                                    }
                                }
                            });
                        } else {
                            alert('Error creating payment intent');
                            $('#confirmPaymentBtn').prop('disabled', false).text('Pay Now');
                        }
                    },
                    error: function() {
                        alert('Error creating payment intent');
                        $('#confirmPaymentBtn').prop('disabled', false).text('Pay Now');
                    }
                });
            }

            // =====================
            // Confirm Payment
            // =====================
            function confirmPayment(paymentIntentId, formData) {
                // Add payment intent ID to form data
                formData.payment_intent_id = paymentIntentId;

                $.ajax({
                    url: "{{ route('order.confirm-payment') }}",
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            // Redirect to thank you page
                            window.location.href = "{{ route('order.details', ':id') }}".replace(':id', response.order_id);
                        } else {
                            alert('Payment confirmation failed');
                            $('#confirmPaymentBtn').prop('disabled', false).text('Pay Now');
                        }
                    },
                    error: function() {
                        alert('Error confirming payment');
                        $('#confirmPaymentBtn').prop('disabled', false).text('Pay Now');
                    }
                });
            }

        });
    </script>
@endpush
