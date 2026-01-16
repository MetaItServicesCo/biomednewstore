@extends('frontend.layouts.frontend')

@section('meta_title', $data->meta_title ?? 'Order Confirmation')

@push('frontend-styles')
    <style>
        .cart-banner {
            margin-top: 6rem;
        }
    </style>
@endpush
@section('frontend-content')
    @php
        $order = $order ?? null;
        $items = $order ? $order->items : [];
    @endphp

    <section class="cart-banner">
        <h1>Order <span>Confirmation</span></h1>
    </section>

    <section class="py-5">
        <div class="container">
            @if ($order)
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-success">
                            <h4 class="alert-heading">Thank You for Your Order!</h4>
                            <p>Your order has been successfully placed and paid for.</p>
                            <hr>
                            <p class="mb-0">Order ID: <strong>#{{ $order->order_id }}</strong></p>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Order Details -->
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5>Order Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Shipping Address</h6>
                                        <p>
                                            {{ $order->first_name }} {{ $order->last_name }}<br>
                                            {{ $order->street_address }}<br>
                                            @if ($order->street_address_2)
                                                {{ $order->street_address_2 }}<br>
                                            @endif
                                            {{ $order->city->name ?? '' }}, {{ $order->state->name ?? '' }}
                                            {{ $order->postal_code }}<br>
                                            {{ $order->country->name ?? '' }}<br>
                                            Phone: {{ $order->phone_number }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Order Information</h6>
                                        <p>
                                            Order Date: {{ $order->created_at->format('M d, Y') }}<br>
                                            Email: {{ $order->email }}<br>
                                            Payment Status: <span
                                                class="badge bg-success">{{ ucfirst($order->payment_status) }}</span><br>
                                            Order Status: <span
                                                class="badge bg-info">{{ ucfirst($order->order_status) }}</span>
                                        </p>
                                    </div>
                                </div>

                                <hr>

                                <h6>Items Ordered</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($items as $item)
                                                <tr>
                                                    <td>{{ $item->product_name }}</td>
                                                    <td>${{ number_format($item->price, 2) }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>${{ number_format($item->subtotal, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5>Order Summary</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <span>Subtotal:</span>
                                    <span>${{ number_format($order->subtotal, 2) }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Shipping:</span>
                                    <span>${{ number_format($order->shipping, 2) }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Tax:</span>
                                    <span>${{ number_format($order->tax, 2) }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>GST:</span>
                                    <span>${{ number_format($order->gst, 2) }}</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between fw-bold">
                                    <span>Total:</span>
                                    <span>${{ number_format($order->total, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger">
                            <h4 class="alert-heading">Order Not Found</h4>
                            <p>The order you're looking for could not be found.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
