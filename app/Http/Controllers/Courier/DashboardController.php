<?php

namespace App\Http\Controllers\Courier;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Courier;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the courier dashboard.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // یا خطای مناسب
        }
        try {
            $courier = Courier::where('user_id', Auth::id())->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle missing courier record gracefully
            return redirect()->route('home')->withErrors(['error' => 'Courier profile not found. Please contact support.']);
        }
        $orders = Order::where('courier_id', $courier->id)->latest()->take(10)->get();
        return view('courier.dashboard', compact('courier', 'orders'));
    }
}
