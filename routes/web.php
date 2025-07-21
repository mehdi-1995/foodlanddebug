<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Seller\DashboardController as DashboardControllerSeller;
use App\Http\Controllers\Courier\DashboardController as DashboardControllerCourier;
use App\Http\Controllers\Customer\PointsController;
use App\Http\Controllers\Seller\MenuItemController;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::post('login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
})->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/restaurants/{restaurant}', [HomeController::class, 'show'])->name('restaurants.show');
Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/seller/dashboard', [DashboardControllerSeller::class, 'index'])->name('seller.dashboard');
    Route::resource('/seller/menu', MenuItemController::class)->names('seller.menu');
});
Route::middleware(['auth', 'role:courier'])->group(function () {
    Route::get('/courier/dashboard', [DashboardControllerCourier::class, 'index'])->name('courier.dashboard');
});
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer/points', [PointsController::class, 'index'])->name('customer.points');
});

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');






