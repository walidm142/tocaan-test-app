<?php

namespace App\Api\V1\Orders\Repositories;

use App\Api\V1\Orders\Models\Order;
use App\Api\V1\Base\Repositories\BaseRepository;
use App\Api\V1\Orders\Repositories\IOrdersRepository;

class OrdersRepository extends BaseRepository implements IOrdersRepository
{


    public function __construct(Order $order)
    {
        parent::__construct($order);
    }
}