<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'logo' => $this->faker->imageUrl(300, 150),
            'rating' => $this->faker->randomFloat(1, 1, 5),
            'category' => $this->faker->randomElement(['ایرانی', 'فست‌فود', 'ایتالیایی', 'کافه']),
        ];
    }
}
