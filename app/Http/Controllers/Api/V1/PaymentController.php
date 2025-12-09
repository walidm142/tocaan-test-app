<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Traits\V1\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PaymentsResource;
use App\Services\V1\Payments\IPaymentsService;

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
        return $this->successResponse(PaymentsResource::collection($payments), 'Payments retrieved successfully');
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
        return $this->successResponse(new PaymentsResource($payment), 'Payment retrieved successfully');
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
