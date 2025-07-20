<?php

use App\Http\Controllers\API\RestaurantController;
use App\Http\Controllers\API\CartController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('restaurants', RestaurantController::class)->only(['index', 'show']);
    Route::apiResource('cart', CartController::class)->only(['index', 'store', 'destroy']);
});
