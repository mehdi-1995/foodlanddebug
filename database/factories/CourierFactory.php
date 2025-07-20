<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class CourierFactory extends Factory
{
    public function definition(): array
    {
        $this->faker->locale = 'fa_IR';

        return [
            'user_id' => User::factory(),
            'vehicle_type' => $this->faker->randomElement(['موتور', 'خودرو', 'دوچرخه']),
            'license_plate' => $this->faker->optional()->regexify('[A-Z0-9]{6}'),
            'is_available' => $this->faker->boolean(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
