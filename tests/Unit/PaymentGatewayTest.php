<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\V1\Payments\PaymentGatewayFactory;
use App\Services\V1\Payments\CreditCardGateway;
use App\Services\V1\Payments\StripeGateway;
use App\Services\V1\Payments\PayPalGateway;

class PaymentGatewayTest extends TestCase
{
    public function test_credit_card_gateway_returns_url()
    {
        $gateway = PaymentGatewayFactory::make('credit_card');
        $url = $gateway->pay(['order_id' => 1, 'amount' => 100]);
        $this->assertStringContainsString('creditcard.example.com', $url);
    }

    public function test_stripe_gateway_returns_url_with_key()
    {
        putenv('STRIPE_KEY=test_stripe_key');
        $gateway = PaymentGatewayFactory::make('stripe');
        $url = $gateway->pay(['order_id' => 2, 'amount' => 200]);
        $this->assertStringContainsString('stripe.example.com', $url);
        $this->assertStringContainsString('test_stripe_key', $url);
    }

    public function test_paypal_gateway_returns_url_with_client_id()
    {
        putenv('PAYPAL_CLIENT_ID=test_paypal_client_id');
        putenv('PAYPAL_SECRET=test_paypal_secret');
        $gateway = PaymentGatewayFactory::make('paypal');
        $url = $gateway->pay(['order_id' => 3, 'amount' => 300]);
        $this->assertStringContainsString('paypal.example.com', $url);
        $this->assertStringContainsString('test_paypal_client_id', $url);
    }

    public function test_invalid_gateway_throws_exception()
    {
        $this->expectException(\InvalidArgumentException::class);
        PaymentGatewayFactory::make('invalid_gateway');
    }
}