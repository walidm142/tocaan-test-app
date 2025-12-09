<?php

namespace App\Services\V1\Orders;

use App\Events\V1\OrderCreated;
use App\Services\V1\BaseService;
use App\Repositories\V1\Orders\OrdersRepository;
use Faker\Provider\en_GB\Payment;
use Illuminate\Support\Facades\Event;
use App\Services\V1\Payments\PaymentGatewayFactory;
use Illuminate\Support\Facades\App;

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

    public function delete($record)
    {
        // if order has payment throw exception
        if ($record->payment()->exists()) {
            throw new \Exception('Cannot delete order with a payment.');
        }
        // Delete related items first
        $record->items()->delete();

        // Then delete the order itself
        return parent::delete($record);
    }

    public function makePayment($order, array $data)
    {
        if ($order->status !== 'confirmed') {
            throw new \Exception('Payments can only be processed for orders in the confirmed status.');
        }

        //if order has payment throw exception
        if ($order->payment()->exists()) {
            throw new \Exception('Order already has a payment.');
        }

        $payment = $order->payment()->create([
            'amount' => $order->total_price,
            'payment_method' => $data['payment_method'],
        ]);

        $gateway = PaymentGatewayFactory::make($data['payment_method']);

        $paymentUrl = $gateway->pay([
            'order_id' => $order->id,
            'amount' => $order->total_price,
            'payment_id' => $payment->id,
        ]);

        // NOTE THIS Line
        // must be in webhook but for simplicity we will update it here until webhook is implemented # walid Mahmoud
        $payment->update(['status' => 'successful']);
        return $paymentUrl;
    }
}