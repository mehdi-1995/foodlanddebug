<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuItemRequest;
use App\Http\Requests\UpdateMenuItemRequest;
use App\Models\Restaurant;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the menu items for the seller's restaurant.
     */
    public function index()
    {
        $restaurant = Restaurant::where('user_id', Auth::id())->firstOrFail();
        $menuItems = MenuItem::where('restaurant_id', $restaurant->id)->get();
        return view('seller.menu.index', compact('menuItems', 'restaurant'));
    }

    /**
     * Show the form for creating a new menu item.
     */
    public function create()
    {
        $restaurant = Restaurant::where('user_id', Auth::id())->firstOrFail();
        return view('seller.menu.create', compact('restaurant'));
    }

    /**
     * Store a newly created menu item in storage.
     */
    public function store(StoreMenuItemRequest $request)
    {
        $restaurant = Restaurant::where('user_id', Auth::id())->firstOrFail();
        MenuItem::create([
            'restaurant_id' => $restaurant->id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'image' => $request->image ?? 'https://via.placeholder.com/300x150',
        ]);

        return redirect()->route('seller.menu.index')->with('success', 'آیتم منو با موفقیت اضافه شد.');
    }

    /**
     * Show the form for editing the specified menu item.
     */
    public function edit(MenuItem $menuItem)
    {
        $this->authorize('update', $menuItem);
        $restaurant = Restaurant::where('user_id', Auth::id())->firstOrFail();
        return view('seller.menu.edit', compact('menuItem', 'restaurant'));
    }

    /**
     * Update the specified menu item in storage.
     */
    public function update(UpdateMenuItemRequest $request, MenuItem $menuItem)
    {
        $this->authorize('update', $menuItem);
        $menuItem->update($request->validated());
        return redirect()->route('seller.menu.index')->with('success', 'آیتم منو با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified menu item from storage.
     */
    public function destroy(MenuItem $menuItem)
    {
        $this->authorize('delete', $menuItem);
        $menuItem->delete();
        return redirect()->route('seller.menu.index')->with('success', 'آیتم منو با موفقیت حذف شد.');
    }
}
