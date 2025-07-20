<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoyaltyPointFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'points' => $this->faker->numberBetween(10, 100),
            'source' => $this->faker->randomElement(['order', 'review']),
            'order_id' => Order::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
