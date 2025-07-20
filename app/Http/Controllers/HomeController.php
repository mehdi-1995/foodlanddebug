<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('home', compact('restaurants'));
    }
}
