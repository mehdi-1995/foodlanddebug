<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Courier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourierOrderController extends Controller
{
    /**
     * Display a listing of the courier's orders.
     */
    public function index()
    {
        $courier = Courier::where('user_id', Auth::id())->firstOrFail();
        $orders = Order::where('courier_id', $courier->id)->with(['user', 'restaurant', 'address'])->get();
        return response()->json($orders);
    }

    /**
     * Update the status of an order.
     */
    public function update(Request $request, Order $order)
    {
        $this->authorize('update', $order);
        $request->validate([
            'status' => 'required|in:preparing,shipped,delivered',
        ]);

        $order->update(['status' => $request->status]);
        return response()->json($order);
    }
}
