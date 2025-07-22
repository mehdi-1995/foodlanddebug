<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'address', 'logo', 'rating', 'category', 'latitude', 'longitude'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Relationship with orders
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function getRatingAttribute()
    {
        return $this->reviews()->average('rating') ?? 0;
    }
}
