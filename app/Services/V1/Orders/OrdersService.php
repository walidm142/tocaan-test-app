<?php

namespace App\Services\V1\Orders;

use App\Events\V1\OrderCreated;
use App\Services\V1\BaseService;
use App\Repositories\V1\Orders\OrdersRepository;
use Illuminate\Support\Facades\Event;

class OrdersService extends BaseService implements IOrdersService
{
    protected $repository;

    public function __construct(OrdersRepository $repository)
    {
        parent::__construct($repository);
    }

    public function create(array $data)
    {
        $order = $this->repository->create($data);
        $order->items()->createMany($data['items']);        
        return $order;
    }

    public function update($order, array $data)
    {
        $order->update($data);

        if (isset($data['items'])) {
            $order->items()->delete();
            $order->items()->createMany($data['items']);
        }

        return $order;
    }
}