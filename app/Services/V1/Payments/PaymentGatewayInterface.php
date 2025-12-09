<?php

namespace App\Services\V1\Payments;

interface PaymentGatewayInterface
{
    public function pay(array $data): string; // returns payment URL
}