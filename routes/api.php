<?php

use App\Http\Controllers\API\RestaurantController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('restaurants', RestaurantController::class)->only(['index', 'show']);
});
