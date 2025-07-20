<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoyaltyPoint extends Model
{
    /** @use HasFactory<\Database\Factories\LoyaltyPointFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'points', 'source', 'order_id'];

    /**
     * Get the user that owns the loyalty points.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the order associated with the loyalty points.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
