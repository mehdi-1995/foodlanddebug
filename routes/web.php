<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Seller\DashboardController as DashboardControllerSeller;
use App\Http\Controllers\Courier\DashboardController as DashboardControllerCourier;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/restaurants/{restaurant}', [HomeController::class, 'show'])->name('restaurants.show');
Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/seller/dashboard', [DashboardControllerSeller::class, 'index'])->name('seller.dashboard');
});
Route::middleware(['auth', 'role:courier'])->group(function () {
    Route::get('/courier/dashboard', [DashboardControllerCourier::class, 'index'])->name('courier.dashboard');
});