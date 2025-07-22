<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Courier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourierController extends Controller
{
    /**
     * Display the courier dashboard.
     */
    public function dashboard()
    {
        $courier = Courier::where('user_id', Auth::id())->firstOrFail();
        $orders = Order::where('courier_id', $courier->id)->with(['address', 'restaurant'])->get();
        return view('courier.dashboard', compact('courier', 'orders'));
    }

    /**
     * Get orders assigned to the courier.
     */
    public function orders()
    {
        $courier = Courier::where('user_id', Auth::id())->firstOrFail();
        $orders = Order::where('courier_id', $courier->id)
            ->with(['address', 'restaurant'])
            ->get();
        return response()->json($orders);
    }

    /**
     * Update the status of an order.
     */
    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,delivered,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        return response()->json(['message' => 'وضعیت سفارش به‌روزرسانی شد.']);
    }
}
