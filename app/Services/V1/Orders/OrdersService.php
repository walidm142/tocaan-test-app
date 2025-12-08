<?php

namespace App\Services\V1\Orders;

use App\Services\V1\BaseService;
use App\Repositories\V1\Orders\OrdersRepository;

class OrdersService extends BaseService implements IOrdersService
{
    protected $repository;

    public function __construct(OrdersRepository $repository)
    {
        parent::__construct($repository);
    }
}