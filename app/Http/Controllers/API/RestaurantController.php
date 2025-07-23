<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RestaurantController extends Controller
{
    public function index()
    {
        // Cache restaurants for 10 minutes
        $restaurants = Cache::remember('restaurants', now()->addMinutes(10), function () {
            return Restaurant::with('menuItems')->get();
        });
        return response()->json($restaurants);
    }

    public function show(Restaurant $restaurant)
    {

        return $restaurant;


        // Cache single restaurant for 10 minutes
        // $restaurant = Cache::remember("restaurant_{$restaurant->id}", now()->addMinutes(10), function () use ($restaurant) {
        //     return $restaurant->load('menuItems');
        // });
        // return response()->json($restaurant);
    }
}
