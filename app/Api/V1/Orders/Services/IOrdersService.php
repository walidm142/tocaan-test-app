<?php

namespace App\Api\V1\Orders\Services;

use App\Api\V1\Orders\Models\Order;
use App\Api\V1\Base\Services\IBaseService;

interface IOrdersService extends IBaseService
{
    /**
     * Make payment for the specified order.
     */
    public function makePayment(Order $order, array $data);
}
