<x-default-layout>
    <div class="row">
        <!-- Order Information -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Order Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Order Details</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Order ID:</strong></td>
                                    <td>{{ $order->order_id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Order Date:</strong></td>
                                    <td>{{ $order->created_at->format('d-M-Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Payment Date:</strong></td>
                                    <td>{{ $order->paid_at ? $order->paid_at->format('d-M-Y H:i') : 'Not Paid' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Shipping Method:</strong></td>
                                    <td>
                                        <span class="badge {{ $order->shipping_method === 'standard' ? 'badge-light-primary' : 'badge-light-success' }}">
                                            {{ ucfirst($order->shipping_method) }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6>Status Information</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Payment Status:</strong></td>
                                    <td>
                                        @php
                                            $paymentBadgeClass = match($order->payment_status) {
                                                'completed' => 'badge-light-success',
                                                'pending' => 'badge-light-warning',
                                                'failed' => 'badge-light-danger',
                                                'refunded' => 'badge-light-info',
                                                default => 'badge-light-secondary'
                                            };
                                        @endphp
                                        <span class="badge {{ $paymentBadgeClass }}">{{ ucfirst($order->payment_status) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Order Status:</strong></td>
                                    <td>
                                        @php
                                            $orderBadgeClass = match($order->order_status) {
                                                'delivered' => 'badge-light-success',
                                                'shipped' => 'badge-light-info',
                                                'processing' => 'badge-light-primary',
                                                'pending' => 'badge-light-warning',
                                                'cancelled' => 'badge-light-danger',
                                                default => 'badge-light-secondary'
                                            };
                                        @endphp
                                        <span class="badge {{ $orderBadgeClass }}">{{ ucfirst($order->order_status) }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="card-title">Customer Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Personal Details</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Name:</strong></td>
                                    <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $order->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Phone:</strong></td>
                                    <td>{{ $order->phone_number }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Company:</strong></td>
                                    <td>{{ $order->company ?: 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6>Shipping Address</h6>
                            <address>
                                {{ $order->street_address }}<br>
                                @if($order->street_address_2)
                                    {{ $order->street_address_2 }}<br>
                                @endif
                                {{ $order->city?->name }}, {{ $order->state?->name }} {{ $order->postal_code }}<br>
                                {{ $order->country?->name }}
                            </address>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Order Summary</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span>${{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping:</span>
                        <span>${{ number_format($order->shipping, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>GST (10%):</span>
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

    <!-- Products Purchased -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Products Purchased</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($item->product_image)
                                                    <img src="{{ asset('storage/products/thumbnails/' . $item->product_image) }}"
                                                         alt="{{ $item->product_name }}"
                                                         class="me-3"
                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                @endif
                                                <div>
                                                    <strong>{{ $item->product_name }}</strong>
                                                    @if($item->product)
                                                        <br><small class="text-muted">{{ $item->product->category?->name }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
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
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary">Edit Order</a>
        </div>
    </div>
</x-default-layout>