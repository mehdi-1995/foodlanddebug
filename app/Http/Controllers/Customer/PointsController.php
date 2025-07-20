<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\LoyaltyPoint;
use Illuminate\Http\Request;

class PointsController extends Controller
{
    /**
     * Display the customer's loyalty points.
     */
    public function index()
    {
        $points = LoyaltyPoint::where('user_id', auth()->id())->get();
        return view('customer.points', compact('points'));
    }
}
