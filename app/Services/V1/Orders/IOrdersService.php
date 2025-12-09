<?php

namespace App\Services\V1\Orders;

use App\Services\V1\IBaseService;

interface IOrdersService extends IBaseService
{
    /**
     * Make payment for the specified order.
     */
    public function makePayment(Order $order, array $data);
}
