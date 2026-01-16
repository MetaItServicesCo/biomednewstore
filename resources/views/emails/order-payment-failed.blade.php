@extends('layouts.email')

@section('content')
<div style="max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif; background-color: #ffffff;">
    <!-- Header -->
    <div style="background-color: #dc3545; color: white; padding: 30px; text-align: center;">
        <h1 style="margin: 0; font-size: 24px;">Payment Failed</h1>
        <p style="margin: 10px 0 0 0; font-size: 16px;">We're sorry, but your payment could not be processed.</p>
    </div>

    <!-- Order Details -->
    <div style="padding: 30px;">
        <div style="background-color: #f8f9fa; padding: 20px; margin-bottom: 20px; border-radius: 5px;">
            <h2 style="margin: 0 0 15px 0; color: #333; font-size: 18px;">Order Details</h2>
            <p style="margin: 5px 0;"><strong>Order ID:</strong> #{{ $order->order_id }}</p>
            <p style="margin: 5px 0;"><strong>Order Date:</strong> {{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
            <p style="margin: 5px 0;"><strong>Payment Status:</strong>
                <span style="color: #dc3545; font-weight: bold;">{{ ucfirst($order->payment_status) }}</span>
            </p>
            @if($errorMessage)
                <p style="margin: 5px 0;"><strong>Error:</strong> {{ $errorMessage }}</p>
            @endif
        </div>

        <!-- Customer Information -->
        <div style="margin-bottom: 20px;">
            <h3 style="color: #333; border-bottom: 2px solid #dc3545; padding-bottom: 5px;">Customer Information</h3>
            <p style="margin: 5px 0;"><strong>Name:</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
            <p style="margin: 5px 0;"><strong>Email:</strong> {{ $order->email }}</p>
            <p style="margin: 5px 0;"><strong>Phone:</strong> {{ $order->phone_number }}</p>
            @if($order->company)
                <p style="margin: 5px 0;"><strong>Company:</strong> {{ $order->company }}</p>
            @endif
        </div>

        <!-- Order Items -->
        <div style="margin-bottom: 20px;">
            <h3 style="color: #333; border-bottom: 2px solid #dc3545; padding-bottom: 5px;">Order Items</h3>
            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <thead>
                    <tr style="background-color: #f8f9fa;">
                        <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Product</th>
                        <th style="border: 1px solid #ddd; padding: 10px; text-align: center;">Qty</th>
                        <th style="border: 1px solid #ddd; padding: 10px; text-align: right;">Price</th>
                        <th style="border: 1px solid #ddd; padding: 10px; text-align: right;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td style="border: 1px solid #ddd; padding: 10px;">
                            <div style="display: flex; align-items: center;">
                                @if($item->product_image)
                                    <img src="{{ asset('storage/' . $item->product_image) }}" alt="{{ $item->product_name }}" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px; border-radius: 5px;">
                                @endif
                                <div>
                                    <strong>{{ $item->product_name }}</strong>
                                    @if($item->product)
                                        <br><small style="color: #666;">SKU: {{ $item->product->sku ?? 'N/A' }}</small>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td style="border: 1px solid #ddd; padding: 10px; text-align: center;">{{ $item->quantity }}</td>
                        <td style="border: 1px solid #ddd; padding: 10px; text-align: right;">${{ number_format($item->price, 2) }}</td>
                        <td style="border: 1px solid #ddd; padding: 10px; text-align: right;">${{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Order Summary -->
        <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px;">
            <h3 style="color: #333; margin: 0 0 15px 0;">Order Summary</h3>
            <div style="display: flex; justify-content: space-between; margin: 5px 0;">
                <span>Subtotal:</span>
                <span>${{ number_format($order->subtotal, 2) }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin: 5px 0;">
                <span>Shipping:</span>
                <span>${{ number_format($order->shipping, 2) }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin: 5px 0;">
                <span>GST (10%):</span>
                <span>${{ number_format($order->gst, 2) }}</span>
            </div>
            <hr style="border: none; border-top: 1px solid #ddd; margin: 10px 0;">
            <div style="display: flex; justify-content: space-between; margin: 5px 0; font-weight: bold; font-size: 18px;">
                <span>Total:</span>
                <span>${{ number_format($order->total, 2) }}</span>
            </div>
        </div>

        <!-- What to do next -->
        <div style="background-color: #fff3cd; border: 1px solid #ffeaa7; padding: 20px; border-radius: 5px; margin-bottom: 20px;">
            <h3 style="color: #856404; margin: 0 0 15px 0;">What happens next?</h3>
            <ul style="color: #856404; margin: 0; padding-left: 20px;">
                <li>Your order has been saved but payment was not completed</li>
                <li>You can try the payment again using a different payment method</li>
                <li>Check your payment method details and try again</li>
                <li>Contact your bank if you believe there was an error</li>
            </ul>
        </div>

        <!-- Retry Payment Button -->
        <div style="text-align: center; margin-bottom: 20px;">
            <a href="{{ route('checkout') }}" style="background-color: #007bff; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block; font-weight: bold;">
                Try Payment Again
            </a>
        </div>

        <!-- Footer Message -->
        <div style="margin-top: 30px; padding: 20px; background-color: #f8f9fa; border-radius: 5px; text-align: center;">
            <p style="margin: 0; color: #666;">
                If you continue to experience issues, please contact our support team for assistance.
            </p>
            <p style="margin: 10px 0 0 0; font-size: 14px; color: #666;">
                We're here to help you complete your order successfully.
            </p>
        </div>
    </div>

    <!-- Footer -->
    <div style="background-color: #f8f9fa; padding: 20px; text-align: center; border-top: 1px solid #ddd;">
        <p style="margin: 0; font-size: 14px; color: #666;">
            © {{ date('Y') }} BioMed New Store. All rights reserved.
        </p>
    </div>
</div>
@endsection