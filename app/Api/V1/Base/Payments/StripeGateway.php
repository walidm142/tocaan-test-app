<?php

namespace App\Api\V1\Base\Payments;

class StripeGateway implements PaymentGatewayInterface
{
    protected string $stripeKey;

    public function __construct()
    {
        $this->stripeKey = env('STRIPE_KEY', '');
        //complete configure here 
    }
    public function pay(array $data): string
    {
        // Simulate generating a payment URL for Stripe using env key
        return 'https://stripe.example.com/pay?order_id=' . $data['order_id'] . '&key=' . $this->stripeKey;
    }
}