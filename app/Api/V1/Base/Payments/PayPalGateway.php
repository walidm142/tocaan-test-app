<?php

namespace App\Api\V1\Base\Payments;

class PayPalGateway implements PaymentGatewayInterface
{
    protected $clientId;
    protected $secret;
    public function __construct()
    {
        $this->clientId = env('PAYPAL_CLIENT_ID');
        $this->secret = env('PAYPAL_SECRET');

         //complete configure here 
    }
    public function pay(array $data): string
    {
        // Simulate generating a payment URL for PayPal using env credentials
        return 'https://paypal.example.com/pay?order_id=' . $data['order_id'] . '&client_id=' . $this->clientId;
    }
}