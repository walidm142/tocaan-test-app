<?php

namespace App\Services\V1\Payments;

class CreditCardGateway implements PaymentGatewayInterface
{
    public function pay(array $data): string
    {
        // Simulate generating a payment URL for credit card
        return 'https://creditcard.example.com/pay?order_id=' . $data['order_id'];
    }
}