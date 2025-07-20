<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartItemRequest;
use App\Models\CartItem;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the cart items.
     */
    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())->with('menuItem')->get();
        return response()->json($cartItems);
    }

    /**
     * Add a new item to the cart.
     */
    public function store(StoreCartItemRequest $request)
    {
        $menuItem = MenuItem::findOrFail($request->menu_item_id);
        $cartItem = CartItem::create([
            'user_id' => Auth::id(),
            'menu_item_id' => $menuItem->id,
            'quantity' => $request->quantity,
            'price' => $menuItem->price,
        ]);

        return response()->json($cartItem, 201);
    }

    /**
     * Remove a cart item.
     */
    public function destroy(CartItem $cartItem)
    {
        $this->authorize('delete', $cartItem);
        $cartItem->delete();
        return response()->json(null, 204);
    }
}
