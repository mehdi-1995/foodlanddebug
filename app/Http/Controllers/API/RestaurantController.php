<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        // Retrieve all restaurants with their menu items
        $restaurants = Restaurant::with('menuItems')->get();
        return response()->json($restaurants);
    }

    public function show(Restaurant $restaurant)
    {
        // Load restaurant with menu items
        $restaurant->load('menuItems');
        return response()->json($restaurant);
    }
}
