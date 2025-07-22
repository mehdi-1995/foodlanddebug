<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the homepage with restaurant search and category filter.
     */
    public function index(Request $request)
    {
        $query = $request->input('search');
        $category = $request->input('category');
        $restaurants = Restaurant::query()
            ->when($query, function ($queryBuilder, $search) {
                return $queryBuilder->where('name', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            })
            ->when($category, function ($queryBuilder, $cat) {
                return $queryBuilder->where('category', $cat);
            })
            ->get();
        $categories = Restaurant::select('category')->distinct()->pluck('category');
        return view('home', compact('restaurants', 'categories'));
    }

    /**
     * Display a specific restaurant's menu with category filter and reviews.
     */
    public function show(Request $request, Restaurant $restaurant)
    {
        $category = $request->input('category');
        $menuItems = $restaurant->menuItems()
            ->when($category, function ($queryBuilder, $cat) {
                return $queryBuilder->where('category', $cat);
            })
            ->get();
        $categories = $restaurant->menuItems()->select('category')->distinct()->pluck('category');
        return view('restaurants.show', compact('restaurant', 'menuItems', 'categories'));
    }
}
