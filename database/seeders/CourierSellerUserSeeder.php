<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CourierSellerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a courier user
        if (!User::where('email', 'courier@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Courier User',
                'email' => 'courier@example.com',
                'role' => 'courier',
                'password' => bcrypt('password'),
            ]);
        }

        // Create a seller user
        if (!User::where('email', 'seller@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Seller User',
                'email' => 'seller@example.com',
                'role' => 'seller',
                'password' => bcrypt('password'),
            ]);
        }
    }
}
