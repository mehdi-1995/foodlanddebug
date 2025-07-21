<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use App\Models\Courier;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    /**
     * Determine whether the user can update the order.
     */
    public function update(User $user, Order $order): Response
    {
        $courier = Courier::where('user_id', $user->id)->first();
        return $courier && $order->courier_id === $courier->id
            ? Response::allow()
            : Response::deny('شما اجازه به‌روزرسانی این سفارش را ندارید.');
    }
}
