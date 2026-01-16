<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_checkout_flow_creates_order_only_after_payment()
    {
        // Create a user
        $user = User::factory()->create();

        // Mock cart data
        $cart = [
            [
                'id' => 1,
                'name' => 'Test Product',
                'price' => 100.00,
                'qty' => 2,
                'image' => 'test.jpg'
            ]
        ];

        // Mock form data
        $formData = [
            'email' => 'test@example.com',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'company' => 'Test Company',
            'street_address' => '123 Test St',
            'street_address_2' => 'Apt 4B',
            'state_id' => 1,
            'city_id' => 1,
            'postal_code' => '12345',
            'country_id' => 1,
            'phone_number' => '+1234567890',
            'cart' => $cart,
            'shipping_method' => 'standard'
        ];

        // Test that no order exists before payment
        $this->assertDatabaseCount('orders', 0);

        // Simulate payment intent creation (this should not create order)
        $response = $this->actingAs($user)->postJson(route('order.payment-intent'), $formData);

        // Should return success with client_secret
        $response->assertStatus(200)
                ->assertJsonStructure(['success', 'client_secret']);

        // Still no order should exist
        $this->assertDatabaseCount('orders', 0);

        // Simulate successful payment confirmation
        $formData['payment_intent_id'] = 'pi_test_success';

        $response = $this->actingAs($user)->postJson(route('order.confirm-payment'), $formData);

        // Should create order now
        $response->assertStatus(200)
                ->assertJson(['success' => true]);

        // Order should now exist
        $this->assertDatabaseCount('orders', 1);

        $order = Order::first();
        $this->assertEquals('completed', $order->payment_status);
        $this->assertEquals('processing', $order->order_status);
        $this->assertEquals(200.00, $order->subtotal); // 100 * 2
        $this->assertEquals(40.00, $order->shipping); // standard shipping
    }
}