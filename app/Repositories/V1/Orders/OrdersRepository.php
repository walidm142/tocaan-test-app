<?php

namespace App\Repositories\V1\Orders;

use App\Models\Order;
use App\Repositories\V1\BaseRepository;
use App\Repositories\V1\Orders\IOrdersRepository;

class OrdersRepository extends BaseRepository implements IOrdersRepository
{


    public function __construct(Order $order)
    {
        parent::__construct($order);
    }
}