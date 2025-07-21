<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Courier
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $vehicle_type
 * @property string|null $license_plate
 * @property bool|null $is_available
 */
class Courier extends Model
{
    /** @use HasFactory<\Database\Factories\CourierFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'vehicle_type', 'license_plate', 'is_available'];

    /**
     * Get the user that owns the courier profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
