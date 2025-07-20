<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'menu_item_id', 'quantity', 'price'];

    /**
     * Get the user that owns the cart item.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the menu item associated with the cart item.
     */
    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }
}
