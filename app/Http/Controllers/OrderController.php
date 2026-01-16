<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Mail\OrderConfirmationMail;
use App\Mail\OrderPaymentFailedMail;
use Illuminate\Support\Facades\Mail;


class OrderController extends Controller
{
    /**
     * Generate a unique random order ID
     *
     * @param int $length
     * @return string
     */
    private function generateUniqueOrderId($length = 8)
    {
        $characters = '0123456789';
        $maxAttempts = 10; // fallback limit
        $attempt = 0;

        do {
            $orderId = '';
            $charactersLength = strlen($characters);
            for ($i = 0; $i < $length; $i++) {
                $orderId .= $characters[rand(0, $charactersLength - 1)];
            }

            $exists = Order::where('order_id', $orderId)->exists();
            $attempt++;

            // fallback in case of collision
            if ($attempt > $maxAttempts) {
                throw new \Exception('Unable to generate unique order ID');
            }
        } while ($exists);

        return $orderId;
    }
    /**
     * Save order from billing form
     */
    public function saveOrder(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'email' => 'required|email',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'company' => 'nullable|string|max:255',
                'street_address' => 'required|string|max:255',
                'street_address_2' => 'nullable|string|max:255',
                'state_id' => 'nullable|exists:states,id',
                'city_id' => 'nullable|exists:cities,id',
                'postal_code' => 'required|string|max:20',
                'country_id' => 'required|exists:countries,id',
                'phone_number' => 'required|string|max:20',
                'cart' => 'required|array|min:1',
                'cart.*.id' => 'required|integer',
                'cart.*.name' => 'required|string',
                'cart.*.price' => 'required|numeric|min:0',
                'cart.*.qty' => 'required|integer|min:1',
                'shipping_method' => 'required|in:standard,pickup',
            ]);

            // Get cart from request
            $cart = $request->cart;

            if (empty($cart)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart is empty'
                ]);
            }

            // Calculate totals - Dynamic shipping based on method, no tax
            $subtotal = 0;
            foreach ($cart as $item) {
                $subtotal += ($item['price'] ?? 0) * ($item['qty'] ?? 1);
            }

            $shipping = ($request->input('shipping_method', 'standard') === 'pickup') ? 0.0 : 40.0;
            $gst = $subtotal * 0.1; // GST is kept as per business requirement
            $total = $subtotal + $shipping + $gst;

            // Create order
            $order = Order::create([
                'order_id' => $this->generateUniqueOrderId(), // <- Unique random ID
                'user_id' => Auth::check() ? Auth::id() : null,
                'email' => $validated['email'],
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'company' => $validated['company'],
                'street_address' => $validated['street_address'],
                'street_address_2' => $validated['street_address_2'] ?? null,
                'state_id' => $validated['state_id'],
                'city_id' => $validated['city_id'],
                'postal_code' => $validated['postal_code'],
                'country_id' => $validated['country_id'],
                'phone_number' => $validated['phone_number'],
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'gst' => $gst,
                'total' => $total,
                'shipping_method' => $request->input('shipping_method', 'standard'),
                'payment_status' => 'pending',
                'order_status' => 'pending',
            ]);

            // Create order items
            foreach ($cart as $item) {
                $itemSubtotal = ($item['price'] ?? 0) * ($item['qty'] ?? 1);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'] ?? null,
                    'product_name' => $item['name'] ?? 'Product',
                    'product_image' => $item['image'] ?? null,
                    'price' => $item['price'] ?? 0,
                    'quantity' => $item['qty'] ?? 1,
                    'subtotal' => $itemSubtotal,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Order created successfully',
                'order_id' => $order->id,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create Stripe Payment Intent (before saving order)
     */
    public function createPaymentIntent(Request $request)
    {
        try {
            // Debug: check env
            $envKey = config('services.stripe.secret');
            if (!$envKey) {
                return response()->json([
                    'success' => false,
                    'message' => 'STRIPE_SECRET_KEY not found in environment'
                ], 500);
            }

            $validated = $request->validate([
                'cart' => 'required|array|min:1',
                'cart.*.id' => 'required|integer',
                'cart.*.name' => 'required|string',
                'cart.*.price' => 'required|numeric|min:0',
                'cart.*.qty' => 'required|integer|min:1',
                'shipping_method' => 'required|in:standard,pickup',
            ]);

            // Calculate totals
            $cart = $request->cart;
            $subtotal = 0;
            foreach ($cart as $item) {
                $subtotal += ($item['price'] ?? 0) * ($item['qty'] ?? 1);
            }

            $shipping = $request->shipping_method === 'pickup' ? 0 : 40.0;
            $gst = $subtotal * 0.1;
            $total = $subtotal + $shipping + $gst;

            $stripeSecret = config('services.stripe.secret');
            if (!$stripeSecret) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stripe secret key not found in env'
                ], 500);
            }
            Stripe::setApiKey($stripeSecret);

            // Create payment intent
            $paymentIntent = PaymentIntent::create([
                'amount' => (int)($total * 100), // Amount in cents
                'currency' => 'usd',
                'description' => 'Order Payment',
                'metadata' => [
                    'cart_count' => count($cart),
                    'shipping_method' => $request->shipping_method,
                ],
            ]);

            return response()->json([
                'success' => true,
                'client_secret' => $paymentIntent->client_secret,
                'payment_intent_id' => $paymentIntent->id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating payment intent: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Confirm Payment and Save Order
     */
    public function confirmPayment(Request $request)
    {
        try {
            $validated = $request->validate([
                'payment_intent_id' => 'required|string',
                'email' => 'required|email',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'company' => 'nullable|string|max:255',
                'street_address' => 'required|string|max:255',
                'street_address_2' => 'nullable|string|max:255',
                'state_id' => 'nullable|exists:states,id',
                'city_id' => 'nullable|exists:cities,id',
                'postal_code' => 'required|string|max:20',
                'country_id' => 'required|exists:countries,id',
                'phone_number' => 'required|string|max:20',
                'cart' => 'required|array|min:1',
                'cart.*.id' => 'required|integer',
                'cart.*.name' => 'required|string',
                'cart.*.price' => 'required|numeric|min:0',
                'cart.*.qty' => 'required|integer|min:1',
                'shipping_method' => 'required|in:standard,pickup',
            ]);

            Stripe::setApiKey(config('services.stripe.secret'));

            // Retrieve payment intent from Stripe
            $paymentIntent = PaymentIntent::retrieve($validated['payment_intent_id']);

            if ($paymentIntent->status === 'succeeded') {
                // Calculate totals
                $cart = $request->cart;
                $subtotal = 0;
                foreach ($cart as $item) {
                    $subtotal += ($item['price'] ?? 0) * ($item['qty'] ?? 1);
                }

                $shipping = $request->shipping_method === 'pickup' ? 0 : 40.0;
                $gst = $subtotal * 0.1;
                $total = $subtotal + $shipping + $gst;

                // Create order
                $order = Order::create([
                    'order_id' => $this->generateUniqueOrderId(), // <- Unique random ID
                    'user_id' => Auth::check() ? Auth::id() : null,
                    'email' => $validated['email'],
                    'first_name' => $validated['first_name'],
                    'last_name' => $validated['last_name'],
                    'company' => $validated['company'],
                    'street_address' => $validated['street_address'],
                    'street_address_2' => $validated['street_address_2'],
                    'state_id' => $validated['state_id'],
                    'city_id' => $validated['city_id'],
                    'postal_code' => $validated['postal_code'],
                    'country_id' => $validated['country_id'],
                    'phone_number' => $validated['phone_number'],
                    'subtotal' => $subtotal,
                    'shipping' => $shipping,
                    'gst' => $gst,
                    'total' => $total,
                    'shipping_method' => $validated['shipping_method'],
                    'payment_status' => 'completed',
                    'order_status' => 'processing',
                    'stripe_payment_intent_id' => $paymentIntent->id,
                    'paid_at' => now(),
                ]);

                // Create order items
                foreach ($cart as $item) {
                    $itemSubtotal = ($item['price'] ?? 0) * ($item['qty'] ?? 1);

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['id'],
                        'product_name' => $item['name'],
                        'product_image' => $item['image'] ?? null,
                        'price' => $item['price'],
                        'quantity' => $item['qty'],
                        'subtotal' => $itemSubtotal,
                    ]);
                }

                // Clear cart from session
                session()->forget('cart');

                // Send order confirmation email
                try {
                    Mail::to($order->email)->queue(new OrderConfirmationMail($order->load('items')));
                } catch (\Exception $e) {
                    Log::error('Failed to send order confirmation email', [
                        'order_id' => $order->id,
                        'email' => $order->email,
                        'error' => $e->getMessage(),
                    ]);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Payment successful',
                    'order_id' => $order->order_id,
                ]);
            } else {
                // Payment failed - create order with failed status
                $cart = $request->cart;
                $subtotal = 0;
                foreach ($cart as $item) {
                    $subtotal += ($item['price'] ?? 0) * ($item['qty'] ?? 1);
                }

                $shipping = $request->shipping_method === 'pickup' ? 0 : 40.0;
                $gst = $subtotal * 0.1;
                $total = $subtotal + $shipping + $gst;

                // Create order with failed payment status
                $order = Order::create([
                    'order_id' => $this->generateUniqueOrderId(),
                    'user_id' => Auth::check() ? Auth::id() : null,
                    'email' => $validated['email'],
                    'first_name' => $validated['first_name'],
                    'last_name' => $validated['last_name'],
                    'company' => $validated['company'],
                    'street_address' => $validated['street_address'],
                    'street_address_2' => $validated['street_address_2'],
                    'state_id' => $validated['state_id'],
                    'city_id' => $validated['city_id'],
                    'postal_code' => $validated['postal_code'],
                    'country_id' => $validated['country_id'],
                    'phone_number' => $validated['phone_number'],
                    'subtotal' => $subtotal,
                    'shipping' => $shipping,
                    'gst' => $gst,
                    'total' => $total,
                    'shipping_method' => $validated['shipping_method'],
                    'payment_status' => 'failed',
                    'order_status' => 'pending',
                    'stripe_payment_intent_id' => $paymentIntent->id,
                    'payment_error_message' => $paymentIntent->last_payment_error ? $paymentIntent->last_payment_error->message : 'Payment was declined',
                ]);

                // Create order items
                foreach ($cart as $item) {
                    $itemSubtotal = ($item['price'] ?? 0) * ($item['qty'] ?? 1);

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['id'],
                        'product_name' => $item['name'],
                        'product_image' => $item['image'] ?? null,
                        'price' => $item['price'],
                        'quantity' => $item['qty'],
                        'subtotal' => $itemSubtotal,
                    ]);
                }

                // Send payment failed email
                try {
                    $errorMessage = $paymentIntent->last_payment_error ? $paymentIntent->last_payment_error->message : 'Payment was declined';
                    Mail::to($order->email)->queue(new OrderPaymentFailedMail($order->load('items'), $errorMessage));
                } catch (\Exception $e) {
                    Log::error('Failed to send payment failed email', [
                        'order_id' => $order->id,
                        'email' => $order->email,
                        'error' => $e->getMessage(),
                    ]);
                }

                return response()->json([
                    'success' => false,
                    'message' => 'Payment failed',
                    'error' => $paymentIntent->last_payment_error ? $paymentIntent->last_payment_error->message : 'Payment was declined',
                ]);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get order details
     */
    public function getOrder($orderId)
    {
        try {
            $order = Order::with('items')->where('order_id', $orderId)->first();

            if (!$order) {
                return redirect()->route('home')->with('error', 'Order not found');
            }

            // Optional: pass items separately if needed
            $items = $order->items;

            return view('frontend.pages.order-confirmation', compact('order', 'items'));
        } catch (\Exception $e) {

            // Log error for debugging
            Log::error('Error retrieving order', [
                'order_id' => $orderId,
                'message'  => $e->getMessage(),
                'file'     => $e->getFile(),
                'line'     => $e->getLine(),
                'user_id'  => auth()->id(),
            ]);

            return redirect()->route('home')->with('error', 'Error retrieving order');
        }
    }

    // ===========================
    // Admin Management Methods
    // ===========================

    /**
     * Display a listing of orders for admin
     */
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('pages.orders.index');
    }

    /**
     * Show the form for editing the specified order
     */
    public function edit($id)
    {
        $order = Order::with(['user', 'items.product', 'state', 'city', 'country'])->findOrFail($id);
        return view('pages.orders.edit', compact('order'));
    }

    /**
     * Display the specified order details
     */
    public function show($id)
    {
        $order = Order::with(['user', 'items.product', 'state', 'city', 'country'])->findOrFail($id);
        return view('pages.orders.show', compact('order'));
    }

    /**
     * Update the specified order status
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,completed,failed,refunded',
            'order_status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'payment_status' => $request->payment_status,
            'order_status' => $request->order_status,
        ]);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully');
    }
}
