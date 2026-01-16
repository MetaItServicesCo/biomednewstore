@extends('frontend.layouts.frontend')

@section('title', 'Cart')

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

        .qty-icons i {
            padding: 2px;
        }

        .qty-icons i.disabled {
            opacity: 0.5;
            cursor: not-allowed;
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
            height: 490px;
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
                    @php $cart = session('cart', []); @endphp
                    @if (count($cart) > 0)

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
                                        @forelse($cart as $item)
                                            @php
                                                $subtotal = ($item['price'] ?? 0) * ($item['qty'] ?? 1);
                                                $itemImage =
                                                    isset($item['image']) && !empty($item['image'])
                                                        ? asset('storage/products/thumbnails/' . $item['image'])
                                                        : asset('frontend/images/offer-img.png');
                                            @endphp
                                            <!-- Item Row -->
                                            <tr class="border-bottom">
                                                <!-- Item -->
                                                <td>
                                                    <div class="item-info">
                                                        <img src="{{ $itemImage }}"
                                                            alt="{{ $item['name'] ?? 'Product' }}">
                                                        <p class="mt-3">{{ $item['name'] ?? 'Product' }}</p>
                                                    </div>
                                                </td>

                                                <!-- Price -->
                                                <td class="item-price">${{ number_format($item['price'] ?? 0, 2) }}</td>

                                                <!-- Qty -->
                                                <td>
                                                    <div class="item-qty" data-id="{{ $item['id'] ?? 0 }}"
                                                        data-stock="{{ $item['stock_qty'] ?? 0 }}">
                                                        <span>{{ $item['qty'] ?? 0 }}</span>
                                                        <div class="qty-icons">
                                                            <i class="fa fa-chevron-up increase-qty"></i>
                                                            <i class="fa fa-chevron-down decrease-qty"></i>
                                                        </div>
                                                    </div>
                                                </td>

                                                <!-- Subtotal -->
                                                <td class="item-subtotal">
                                                    <div
                                                        class="d-flex gap-3 align-items-start justify-content-center align-items-center">
                                                        <p class="mt-3">${{ number_format($subtotal, 2) }}</p>
                                                        <div class="item-actions">
                                                            <div class="item-ico remove-item"
                                                                data-id="{{ $item['id'] ?? 0 }}">
                                                                <i class="fa-solid fa-xmark"></i>
                                                            </div>
                                                            <div class="item-ico edit-item"
                                                                data-slug="{{ $item['slug'] ?? '#' }}"><i
                                                                    class="fa fa-pen"></i></div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Your cart is empty.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>


                            <!-- Buttons -->
                            <div class="cart-actions mt-3">
                                <a href="{{ route('products') }}">
                                    <button class="btn-outline">Continue Shopping</button>
                                </a>
                                <button class="btn-outline danger" id="clear_cart">Clear Shopping Cart</button>
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

                                <div class="summary-row mt-3 summary-subtotal">
                                    <span>Subtotal</span>
                                    <span>$0.00</span>
                                </div>

                                <div class="summary-row  mt-3 summary-shipping">
                                    <span>Shipping</span>
                                    <span>$40.00</span>
                                </div>
                                <p class="small-text  mt-3">
                                    (Standard Rate - Price may vary depending on the item/destination. TECS Staff will
                                    contact
                                    you.)
                                </p>

                                <div class="summary-row  mt-3 summary-gst">
                                    <span>GST (10%)</span>
                                    <span>$0.00</span>
                                </div>
                                <div class="summary-total  mt-3 summary-total-amount">
                                    <span>Order Total</span>
                                    <span>$0.00</span>
                                </div>

                                <a href="{{ route('billing') }}">
                                    <button class="checkout-btn mt-3">Proceed to Checkout</button>
                                </a>

                            </div>
                        </div>
                    @else
                        <div class="col-lg-12">
                            <div class="empty-cart-wrapper text-center">

                                <div class="empty-cart-icon">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </div>

                                <h3>Your cart is empty</h3>
                                <p>
                                    Looks like you haven’t added anything to your cart yet.
                                    Start shopping to explore our latest products.
                                </p>

                                <a href="{{ route('products') }}">
                                    <button class="btn-outline mt-3">
                                        Continue Shopping
                                    </button>
                                </a>

                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>








        {{-- ================= pruduct sectiion ============= --}}
        <x-our-latest-products />

        {{-- ================faqs section ================ --}}
        {{-- <x-faq-section :faqs="$faqs" heading="Frequently Asked Questions" subheading="" subtext=""
        image="frontend/images/hero-main-img.png" :visible="4" /> --}}

    </section>
@endsection

@push('frontend-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Get cart object from Blade
            const cart = @json($cart); // cart object with product IDs as keys

            // Function to update summary
            function updateSummary() {
                let subtotal = 0;

                // Calculate subtotal from all rows
                document.querySelectorAll('.cart-table tbody tr').forEach(row => {
                    const qtyElem = row.querySelector('.item-qty span');
                    const priceElem = row.querySelector('.item-price');

                    if (qtyElem && priceElem) {
                        const qty = parseInt(qtyElem.innerText) || 0;
                        const price = parseFloat(priceElem.innerText.replace('$', '')) || 0;
                        subtotal += price * qty;
                    }
                });

                // Get shipping and tax rates
                const shipping = 40.00;
                const taxRate = 0.10;

                // Calculate totals
                const gst = subtotal * taxRate;
                const orderTotal = subtotal + shipping + gst;

                // Update summary card using class names
                const subtotalElem = document.querySelector('.summary-subtotal span:last-child');
                const shippingElem = document.querySelector('.summary-shipping span:last-child');
                const gstElem = document.querySelector('.summary-gst span:last-child');
                const totalElem = document.querySelector('.summary-total-amount span:last-child');

                if (subtotalElem) subtotalElem.innerText = `$${subtotal.toFixed(2)}`;
                if (shippingElem) shippingElem.innerText = `$${shipping.toFixed(2)}`;
                if (gstElem) gstElem.innerText = `$${gst.toFixed(2)}`;
                if (totalElem) totalElem.innerText = `$${orderTotal.toFixed(2)}`;
            }

            // Function to update subtotal for a specific row
            function updateRowSubtotal(row) {
                const qtyElem = row.querySelector('.item-qty span');
                const priceElem = row.querySelector('.item-price');
                const subtotalElem = row.querySelector('.item-subtotal p');

                if (qtyElem && priceElem && subtotalElem) {
                    const qty = parseInt(qtyElem.innerText) || 0;
                    const price = parseFloat(priceElem.innerText.replace('$', '')) || 0;
                    const subtotal = price * qty;

                    subtotalElem.innerText = `$${subtotal.toFixed(2)}`;
                }
            }

            // Handle quantity changes
            document.querySelectorAll('.item-qty').forEach(box => {
                const plusBtn = box.querySelector('.increase-qty');
                const minusBtn = box.querySelector('.decrease-qty');
                const qtyNumber = box.querySelector('span');
                const row = box.closest('tr');

                // Convert data-id to number to match cart keys
                const productId = parseInt(box.dataset.id);

                // Get stock from data attribute
                const stock = parseInt(box.dataset.stock) || 0;

                // Function to update button states
                function updateButtonStates() {
                    const qty = parseInt(qtyNumber.innerText);

                    // Disable minus button if qty is 1
                    if (qty <= 1) {
                        minusBtn.classList.add('disabled');
                    } else {
                        minusBtn.classList.remove('disabled');
                    }

                    // Disable plus button if qty equals stock
                    if (qty >= stock) {
                        plusBtn.classList.add('disabled');
                    } else {
                        plusBtn.classList.remove('disabled');
                    }
                }

                // Initialize button states on load
                updateButtonStates();

                // Decrease qty
                minusBtn.addEventListener('click', () => {
                    let qty = parseInt(qtyNumber.innerText);
                    if (qty > 1) {
                        qty = qty - 1;
                        qtyNumber.innerText = qty;

                        // Update row subtotal
                        updateRowSubtotal(row);

                        // Update session and summary
                        updateQuantityInCart(productId, qty);

                        // Update button states
                        updateButtonStates();
                    }
                });

                // Increase qty
                plusBtn.addEventListener('click', () => {
                    let qty = parseInt(qtyNumber.innerText);
                    if (qty < stock) {
                        qty = qty + 1;
                        qtyNumber.innerText = qty;

                        // Update row subtotal
                        updateRowSubtotal(row);

                        // Update session and summary
                        updateQuantityInCart(productId, qty);

                        // Update button states
                        updateButtonStates();
                    }
                });
            });

            // Function to update quantity in session via AJAX
            function updateQuantityInCart(productId, qty) {
                fetch("{{ route('cart.update-qty') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            qty: qty
                        })
                    })
                    .then(res => res.json())
                    .then(res => {
                        if (res.success) {
                            // Update summary calculations
                            updateSummary();
                        } else {
                            toastr.error(res.message || 'Failed to update quantity');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        toastr.error('Something went wrong');
                    });
            }

            // Initialize summary on page load
            updateSummary();

            // Clear cart functionality
            const clearCartBtn = document.getElementById('clear_cart');

            if (clearCartBtn) {
                clearCartBtn.addEventListener('click', function() {
                    if (!confirm('Are you sure you want to clear the shopping cart?')) return;

                    fetch("{{ route('cart.clear') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content,
                                'Content-Type': 'application/json'
                            },
                        })
                        .then(res => res.json())
                        .then(res => {
                            if (res.success) {
                                toastr.success(res.message || 'Cart cleared successfully');

                                if (window.updateCartCount) {
                                    window.updateCartCount({});
                                }
                                // Optional: reload page to update table
                                setTimeout(() => {
                                    location.reload();
                                }, 500);
                            } else {
                                toastr.error('Could not clear cart');
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            toastr.error('Something went wrong');
                        });
                });
            }

            // Remove cart item
            document.querySelectorAll('.remove-item').forEach(btn => {
                btn.addEventListener('click', function() {
                    const productId = this.dataset.id;
                    if (!confirm('Are you sure you want to remove this item?')) return;

                    fetch("{{ route('cart.remove') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                product_id: productId
                            })
                        })
                        .then(res => res.json())
                        .then(res => {
                            if (res.success) {
                                toastr.success(res.message || 'Item removed');
                                // Remove the row from table
                                const row = btn.closest('tr');
                                if (row) row.remove();

                                if (window.updateCartCount) {
                                    window.updateCartCount(res.cart || {});
                                }
                                // Update summary after removal
                                updateSummary();

                                // Optional: reload page if cart is empty
                                const tbody = document.querySelector('.cart-table tbody');
                                if (!tbody || !tbody.querySelector('tr:not(:empty)')) {
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1000);
                                }
                            } else {
                                toastr.error('Could not remove item');
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            toastr.error('Something went wrong');
                        });
                });
            });

            // Edit / redirect to product detail
            document.querySelectorAll('.edit-item').forEach(btn => {
                btn.addEventListener('click', function() {
                    const slug = this.dataset.slug; // we'll store slug here
                    // Redirect to product page
                    window.location.href = `/product/${slug}`;
                });
            });

        });
    </script>
@endpush
