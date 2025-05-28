<?php

use App\Http\Controllers\Api\V1\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(CheckoutController::class)->group(function () {
        Route::post('/checkout', 'checkout');
    });
});
