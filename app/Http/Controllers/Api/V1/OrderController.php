<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Order;
use App\Traits\V1\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\OrderResource;
use App\Services\V1\Orders\IOrdersService;
use App\Http\Requests\V1\Orders\CreateOrderRequest;

class OrderController extends Controller
{

    use ApiResponseTrait;
    
    public function __construct(protected IOrdersService $ordersService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = $this->ordersService->all();
        return $this->successResponse(OrderResource::collection($orders));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateOrderRequest $request)
    {
        $order = $this->ordersService->create($request->all());
        return $this->successResponse(new OrderResource($order->refresh()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return $this->successResponse(new OrderResource($order));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $this->ordersService->update($order, $request->all());
        return $this->successResponse(new OrderResource($order->refresh()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $this->ordersService->delete($order);
        return $this->successResponse(null, 'Order deleted successfully');
    }
}
