<?php

// app/Http/Controllers/PaymentController.php
namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Shetabit\Multipay\Facades\Multipay;
// use App\Models\Order;

// class PaymentController extends Controller
// {
//     public function initiatePayment(Request $request)
//     {
//         $request->validate([
//             'order_id' => 'required|exists:orders,id',
//             'amount' => 'required|integer',
//         ]);

//         $order = Order::findOrFail($request->order_id);

//         $payment = Multipay::purchase(
//             [
//                 'amount' => $request->amount,
//                 'description' => 'پرداخت سفارش شماره ' . $order->id,
//                 'callbackUrl' => url('/api/payment/callback?order_id=' . $order->id),
//             ],
//             function ($driver, $transactionId) use ($order) {
//                 // You can save the transaction id to the order or database if needed
//                 $order->transaction_id = $transactionId;
//                 $order->save();
//             }
//         )->pay()->toJson();

//         return response($payment, 200, ['Content-Type' => 'application/json']);
//     }

//     public function callback(Request $request)
//     {
//         $orderId = $request->query('order_id');
//         $order = Order::findOrFail($orderId);

//         $receipt = Multipay::amount($order->amount)->transactionId($order->transaction_id)->verify();

//         if ($receipt->isSuccessful()) {
//             $order->status = 'paid';
//             $order->save();
//             return redirect('/profile');
//         }

//         return redirect('/checkout?error=payment_failed');
//     }
// }
