<?php

namespace App\Api\V1\Base\Payments;

interface PaymentGatewayInterface
{
    public function pay(array $data): string; // returns payment URL
}