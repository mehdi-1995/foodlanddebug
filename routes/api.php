<?php

use App\Http\Controllers\API\RestaurantController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\LoyaltyPointController;
use App\Http\Controllers\API\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->name('api.')->group(function () {
    Route::apiResource('restaurants', RestaurantController::class)->only(['index', 'show']);
    Route::apiResource('cart', CartController::class)->only(['index', 'store', 'destroy']);
    Route::apiResource('loyalty-points', LoyaltyPointController::class)->only(['index', 'store']);
    Route::apiResource('orders', OrderController::class)->only(['store']);
});
