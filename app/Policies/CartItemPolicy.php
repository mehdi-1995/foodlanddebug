<?php

namespace App\Policies;

use App\Models\CartItem;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CartItemPolicy
{
    /**
     * Determine whether the user can delete the cart item.
     */
    public function delete(User $user, CartItem $cartItem): bool
    {
        return $user->id === $cartItem->user_id;
    }
}
