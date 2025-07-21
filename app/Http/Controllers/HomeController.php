<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the homepage with restaurant search.
     */
    public function index(Request $request)
    {
        $query = $request->input('search');
        $restaurants = Restaurant::query()
            ->when($query, function ($queryBuilder, $search) {
                return $queryBuilder->where('name', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            })
            ->get();
        return view('home', compact('restaurants'));
    }

    /**
     * Display a specific restaurant's menu.
     */
    public function show(Restaurant $restaurant)
    {
        $menuItems = $restaurant->menuItems;
        return view('restaurants.show', compact('restaurant', 'menuItems'));
    }
}
