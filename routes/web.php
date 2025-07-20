<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Seller\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/restaurants/{restaurant}', [HomeController::class, 'show'])->name('restaurants.show');
Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/seller/dashboard', [DashboardController::class, 'index'])->name('seller.dashboard');
});
