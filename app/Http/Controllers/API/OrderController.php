<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\CartItem;
use App\Jobs\NotifyOrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Create a new order from cart items.
     */
    public function store(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:addresses,id',
        ]);

        $cartItems = CartItem::where('user_id', Auth::id())->get();
        if ($cartItems->isEmpty()) {
            return response()->json(['error' => 'Cart is empty'], 400);
        }

        $totalPrice = $cartItems->sum(fn($item) => $item->price * $item->quantity);

        $order = Order::create([
            'user_id' => Auth::id(),
            'restaurant_id' => $cartItems->first()->menuItem->restaurant_id,
            'address_id' => $request->address_id,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        NotifyOrderStatus::dispatch($order);

        $cartItems->each->delete();

        return response()->json($order, 201);
    }
}
