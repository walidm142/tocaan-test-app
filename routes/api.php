<?php

use Illuminate\Support\Facades\Route;

use App\Api\V1\Users\Controllers\UserController;
use App\Api\V1\Orders\Controllers\OrderController;
use App\Api\V1\Payments\Controllers\PaymentController;





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
