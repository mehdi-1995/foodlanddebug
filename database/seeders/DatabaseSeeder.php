<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\MenuItem;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\LoyaltyPoint;
use App\Models\Courier;
use App\Models\Review;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ایجاد کاربران
        if (!User::where('email', 'moshtari@mesal.ir')->exists()) {
            User::factory()->create([
                'name' => 'مشتری آزمایشی',
                'email' => 'moshtari@mesal.ir',
                'phone' => '09123456789',
                'role' => 'customer',
            ]);
        }

        if (!User::where('email', 'foroshande@mesal.ir')->exists()) {
            User::factory()->create([
                'name' => 'فروشنده آزمایشی',
                'email' => 'foroshande@mesal.ir',
                'phone' => '09129876543',
                'role' => 'seller',
            ]);
        }

        // Add courier and seller users
        $this->call(\Database\Seeders\CourierSellerUserSeeder::class);

        // ایجاد کوریرها و آدرس‌ها
        Courier::factory()->count(5)->create();
        Address::factory()->count(10)->create();

        // ایجاد رستوران‌ها و آیتم‌های منو
        Restaurant::factory()->count(5)->create()->each(function ($restaurant) {
            MenuItem::factory()->count(3)->create(['restaurant_id' => $restaurant->id]);
            Review::factory()->count(2)->create(['restaurant_id' => $restaurant->id]);
        });

        // ایجاد آیتم‌های سبد خرید، سفارش‌ها و امتیازات وفاداری
        CartItem::factory()->count(10)->create();
        Order::factory()->count(10)->create();
        LoyaltyPoint::factory()->count(20)->create();
    }
}
