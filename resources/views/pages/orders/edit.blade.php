<x-default-layout>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Update Order Status</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="payment_status" class="form-label">Payment Status</label>
                                    <select name="payment_status" id="payment_status" class="form-select" required>
                                        <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="completed" {{ $order->payment_status === 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>Failed</option>
                                        <option value="refunded" {{ $order->payment_status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="order_status" class="form-label">Order Status</label>
                                    <select name="order_status" id="order_status" class="form-select" required>
                                        <option value="pending" {{ $order->order_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $order->order_status === 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="shipped" {{ $order->order_status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="delivered" {{ $order->order_status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="cancelled" {{ $order->order_status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Update Order</button>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
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
                    <div class="mb-3">
                        <strong>Order ID:</strong> {{ $order->order_id }}
                    </div>
                    <div class="mb-3">
                        <strong>Customer:</strong> {{ $order->first_name }} {{ $order->last_name }}
                    </div>
                    <div class="mb-3">
                        <strong>Email:</strong> {{ $order->email }}
                    </div>
                    <hr>
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

            <!-- Current Status -->
            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="card-title">Current Status</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Payment Status:</strong>
                        @php
                            $paymentBadgeClass = match($order->payment_status) {
                                'completed' => 'badge-light-success',
                                'pending' => 'badge-light-warning',
                                'failed' => 'badge-light-danger',
                                'refunded' => 'badge-light-info',
                                default => 'badge-light-secondary'
                            };
                        @endphp
                        <span class="badge {{ $paymentBadgeClass }} ms-2">{{ ucfirst($order->payment_status) }}</span>
                    </div>
                    <div class="mb-3">
                        <strong>Order Status:</strong>
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
                        <span class="badge {{ $orderBadgeClass }} ms-2">{{ ucfirst($order->order_status) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-default-layout>