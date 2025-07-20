<?php

namespace App\Http\Controllers\Courier;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Courier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the courier dashboard.
     */
    public function index()
    {
        $courier = Courier::where('user_id', auth()->id())->firstOrFail();
        $orders = Order::where('courier_id', $courier->id)->latest()->take(10)->get();
        return view('courier.dashboard', compact('courier', 'orders'));
    }
}
