<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SellerDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_seller_can_access_dashboard()
    {
        $user = User::factory()->create(['role' => 'seller']);
        $restaurant = Restaurant::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/seller/dashboard');

        $response->assertStatus(200)
                 ->assertViewIs('seller.dashboard')
                 ->assertViewHas('restaurant', $restaurant);
    }

    public function test_non_seller_cannot_access_dashboard()
    {
        $user = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($user)->get('/seller/dashboard');

        $response->assertStatus(403);
    }
}