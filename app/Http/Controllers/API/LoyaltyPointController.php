<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoyaltyPointRequest;
use App\Models\LoyaltyPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoyaltyPointController extends Controller
{
    /**
     * Display a listing of the user's loyalty points.
     */
    public function index()
    {
        $points = LoyaltyPoint::where('user_id', Auth::id())->get();
        return response()->json($points);
    }

    /**
     * Add points for a user (e.g., after an order).
     */
    public function store(StoreLoyaltyPointRequest $request)
    {
        $point = LoyaltyPoint::create([
            'user_id' => Auth::id(),
            'points' => $request->points,
            'source' => $request->source,
            'order_id' => $request->order_id,
        ]);

        return response()->json($point, 201);
    }
}
