<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\CartItem;
use App\Jobs\NotifyOrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class OrderController extends Controller
{
    /**
     * Create a new order from cart items and initiate payment.
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

        // Initiate payment
        $invoice = (new Invoice)->amount((int)$totalPrice);
        $paymentUrl = Payment::purchase($invoice, function($driver, $transactionId) use ($order) {
            $order->update(['transaction_id' => $transactionId]);
        })->pay()->render();

        NotifyOrderStatus::dispatch($order);

        $cartItems->each->delete();

        return response()->json(['order' => $order, 'payment_url' => $paymentUrl], 201);
    }

    /**
     * Verify payment callback.
     */
    public function verify(Request $request)
    {
        $order = Order::where('transaction_id', $request->Authority)->firstOrFail();
        try {
            $receipt = Payment::amount((int)$order->total_price)->transactionId($request->Authority)->verify();
            $order->update(['status' => 'paid']);
            return redirect()->route('customer.points')->with('success', 'پرداخت با موفقیت انجام شد.');
        } catch (\Exception $e) {
            $order->update(['status' => 'failed']);
            return redirect()->route('home')->with('error', 'پرداخت ناموفق بود.');
        }
    }
}
