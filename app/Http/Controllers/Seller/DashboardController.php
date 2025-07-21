<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the seller dashboard.
     */
    public function index()
    {
        $restaurant = Restaurant::where('user_id', Auth::id())->firstOrFail();
        $orders = Order::where('restaurant_id', $restaurant->id)->latest()->take(10)->get();
        return view('seller.dashboard', compact('restaurant', 'orders'));
    }
}
