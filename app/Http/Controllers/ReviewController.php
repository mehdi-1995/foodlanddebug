<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a new review for a restaurant.
     */
    public function store(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:500',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'restaurant_id' => $restaurant->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('restaurants.show', $restaurant->id)
                        ->with('success', 'نظر شما با موفقیت ثبت شد.');
    }
}
