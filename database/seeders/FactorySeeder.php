<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Courier;
use App\Models\Restaurant;
use App\Models\MenuItem;
use App\Models\Address;
use App\Models\Order;

class FactorySeeder extends Seeder
{
    public function run()
    {
        // Create sellers with restaurants and menu items
        User::factory()
            ->count(5)
            ->state(['role' => 'seller'])
            ->has(Restaurant::factory()
                ->count(1)
                ->has(MenuItem::factory()->count(10))
            )
            ->create();

        // Create couriers linked to users with role courier
        User::factory()
            ->count(5)
            ->state(['role' => 'courier'])
            ->create()
            ->each(function ($user) {
                Courier::factory()->create(['user_id' => $user->id]);
            });

        // Create customers with addresses and orders
        User::factory()
            ->count(10)
            ->state(['role' => 'customer'])
            ->create()
            ->each(function ($user) {
                // Create addresses for customer
                $addresses = Address::factory()->count(2)->create(['user_id' => $user->id]);

                // Create orders for customer
                $restaurants = Restaurant::all();
                $couriers = Courier::all();

                foreach (range(1, 3) as $i) {
                    Order::factory()->create([
                        'user_id' => $user->id,
                        'restaurant_id' => $restaurants->random()->id,
                        'address_id' => $addresses->random()->id,
                        'courier_id' => $couriers->random()->id,
                    ]);
                }
            });
    }
}
