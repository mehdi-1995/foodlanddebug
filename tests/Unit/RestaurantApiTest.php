<?php

namespace Tests\Unit;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RestaurantApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_restaurants()
    {
        $user = User::factory()->create();
        Restaurant::factory()->count(3)->create();

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/restaurants');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_can_show_restaurant()
    {
        $user = User::factory()->create();
        $restaurant = Restaurant::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->getJson("/api/restaurants/{$restaurant->id}");

        $response->assertStatus(200)
            ->assertJson(['id' => $restaurant->id]);
    }
}
