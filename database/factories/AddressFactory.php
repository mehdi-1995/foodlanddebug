<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class AddressFactory extends Factory
{
    public function definition(): array
    {
        $this->faker->locale = 'fa_IR';

        return [
            'user_id' => User::factory(),
            'title' => $this->faker->randomElement(['خانه', 'محل کار', 'آدرس موقت']),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'postal_code' => $this->faker->postcode(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
