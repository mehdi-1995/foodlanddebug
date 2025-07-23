<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\LoyaltyPointController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CourierOrderController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'user']);
Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show'])->name('restaurants.show');
Route::middleware('auth:sanctum')->name('api.')->group(function () {
    Route::apiResource('cart', CartController::class)->only(['index', 'store', 'destroy']);
    Route::apiResource('loyalty-points', LoyaltyPointController::class)->only(['index', 'store']);
    Route::apiResource('orders', OrderController::class)->only(['store']);
    Route::prefix('courier-orders')->group(function () {
        Route::get('/', [CourierOrderController::class, 'index'])->name('courier-orders.index');
        Route::put('/{order}', [CourierOrderController::class, 'update'])->name('courier-orders.update');
    });
});
