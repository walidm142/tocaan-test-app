<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\PaymentController;




Route::prefix('/v1')->group(function () {

    Route::post('login', [UserController::class, 'login']);
    Route::post('register', [UserController::class, 'register']);

    Route::middleware('jwt')->group(function () {
        // me endpoint
        Route::get('me', [UserController::class, 'me']);
        // logout endpoint
        Route::post('logout', [UserController::class, 'logout']);

        //orders endpoints
        Route::post('orders/{order}/payment', [OrderController::class, 'makePayment']);
        Route::apiResource('/orders', OrderController::class);

        //payments endpoints
        Route::apiResource('/payments', PaymentController::class)->only(['index', 'show']);
    });
});
