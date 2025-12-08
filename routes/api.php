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

        Route::apiResource('/orders', OrderController::class);
        Route::apiResource('/payments', PaymentController::class);
    });
});
