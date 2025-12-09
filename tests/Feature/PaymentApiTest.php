<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Order;
use App\Models\Payment;

class PaymentApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_make_payment_returns_payment_url()
    {
        $order = Order::factory()->create(['amount' => 150]);
        $response = $this->postJson('/api/payments', [
            'order_id' => $order->id,
            'payment_method' => 'stripe',
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure(['payment_url']);
        $this->assertStringContainsString('stripe.example.com', $response->json('payment_url'));
    }

    public function test_make_payment_with_env_gateway()
    {
        putenv('PAYMENT_GATEWAY=paypal');
        $order = Order::factory()->create(['amount' => 250]);
        $response = $this->postJson('/api/payments', [
            'order_id' => $order->id,
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure(['payment_url']);
        $this->assertStringContainsString('paypal.example.com', $response->json('payment_url'));
    }

    public function test_make_payment_invalid_gateway()
    {
        $order = Order::factory()->create(['amount' => 350]);
        $response = $this->postJson('/api/payments', [
            'order_id' => $order->id,
            'payment_method' => 'invalid_gateway',
        ]);
        $response->assertStatus(422);
    }
}