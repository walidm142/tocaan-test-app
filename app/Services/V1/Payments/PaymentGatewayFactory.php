<?php

namespace App\Services\V1\Payments;

class PaymentGatewayFactory
{
    public static function make(string $method): PaymentGatewayInterface
    {
        switch ($method) {
            case 'credit_card':
                return new CreditCardGateway();
            case 'stripe':
                return new StripeGateway();
            case 'paypal':
                return new PayPalGateway();
            default:
                throw new \InvalidArgumentException("Unsupported payment method: {$method}");
        }
    }
}