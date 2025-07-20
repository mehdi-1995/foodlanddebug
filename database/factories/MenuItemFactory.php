<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Restaurant;

class MenuItemFactory extends Factory
{
    public function definition(): array
    {
        // تنظیم locale به فارسی
        $this->faker->locale = 'fa_IR';

        return [
            'restaurant_id' => Restaurant::factory(),
            'name' => $this->faker->randomElement([
                'چلوکباب کوبیده',
                'جوجه کباب',
                'زرشک پلو با مرغ',
                'قرمه سبزی',
                'فسنجان',
            ]),
            'price' => $this->faker->randomFloat(2, 50000, 200000), // قیمت بین 50,000 تا 200,000 تومان
            'category' => $this->faker->randomElement([
                'غذای اصلی',
                'پیش‌غذا',
                'دسر',
                'نوشیدنی',
            ]),
            'updated_at' => now(),
            'created_at' => now(),
        ];
    }
}
