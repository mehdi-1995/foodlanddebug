<?php

use App\Http\Controllers\API\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Seller\DashboardController as DashboardControllerSeller;
use App\Http\Controllers\Courier\DashboardController as DashboardControllerCourier;
use App\Http\Controllers\Customer\PointsController;
use App\Http\Controllers\Seller\MenuItemController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\ReviewController;
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

Route::get('register', function () {
    return view('auth.register');
})->name('register');

Route::post('register', function (Request $request) {
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'phone' => ['required', 'string', 'max:20'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    $user = \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => $request->password,
        'role' => 'customer',
    ]);

    Auth::login($user);
    $request->session()->regenerate();
    return redirect()->intended('/');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/restaurants/{restaurant}', [HomeController::class, 'show'])->name('restaurants.show');
Route::get('/contact', function () {
    return view('home');
})->name('contact');
Route::get('/faq', function () {
    return view('home');
})->name('faq');
Route::get('/terms', function () {
    return view('home');
})->name('terms');
Route::get('/profile', function () {
    return view('home');
})->name('profile')->middleware('auth');

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

Route::post('/restaurants/{restaurant}/reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');
Route::resource('cart', CartController::class)->only(['index', 'store', 'destroy'])->middleware('auth');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store')->middleware('auth');
Route::get('/payment/verify', [OrderController::class, 'verify'])->name('payment.verify')->middleware('auth');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

Route::get('/{any}', function () {
    return view('home');
})->where('any', '.*');
