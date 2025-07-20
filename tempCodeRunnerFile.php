<?php
public function store(Request $request)
    {
        $request->validate([
            'menu_item_id' => 'required|exists:menu_items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $menuItem = MenuItem::findOrFail($request->menu_item_id);
        $cartItem = CartItem::create([
            'user_id' => Auth::id(),
            'menu_item_id' => $menuItem->id,
            'quantity' => $request->quantity,
            'price' => $menuItem->price,
        ]);

        return response()->json($cartItem, 201);
    }