<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/restaurants/{restaurant}', [HomeController::class, 'show'])->name('restaurants.show');
