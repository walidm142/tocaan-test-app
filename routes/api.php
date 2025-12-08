<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\PaymentController;


Route::prefix('/v1')->group(function () {
    Route::apiResource('/orders', OrderController::class);
    Route::apiResource('/payments', PaymentController::class);
});
