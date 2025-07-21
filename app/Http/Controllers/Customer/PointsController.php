<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\LoyaltyPoint;
use Illuminate\Http\Request;

class PointsController extends Controller
{
    /**
     * Display the customer's loyalty points.
     */
    public function index()
    {
        $points = LoyaltyPoint::where('user_id', Auth::id())->get();
        return view('customer.points', compact('points'));
    }
}
