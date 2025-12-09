<?php

namespace App\Api\V1\Payments\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Api\V1\Payments\Models\Payment;
use App\Api\V1\Base\Traits\ApiResponseTrait;
use App\Api\V1\Payments\Services\IPaymentsService;
use App\Api\V1\Payments\Resources\PaymentsResource;

class PaymentController extends Controller
{
    use ApiResponseTrait;

    public function __construct(private IPaymentsService $paymentsService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = $this->paymentsService->all();
        return $this->successResponse(PaymentsResource::collection($payments['data']), 'Payments retrieved successfully', 200, $payments['meta']);
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
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        $payment = $this->paymentsService->find($payment->id);
        return $this->successResponse(new PaymentsResource($payment), 'Payment retrieved successfully', 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
