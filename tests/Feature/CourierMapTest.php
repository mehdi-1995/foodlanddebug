<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Courier;
use App\Models\Order;
use App\Models\Address;
use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourierMapTest extends TestCase
{
    use RefreshDatabase;

    public function test_courier_map_displays_orders_and_routes()
    {
        $user = User::factory()->create(['role' => 'courier']);
        $courier = Courier::factory()->create(['user_id' => $user->id]);
        $restaurant = Restaurant::factory()->create(['latitude' => 35.6892, 'longitude' => 51.3890]);
        $order = Order::factory()->create(['courier_id' => $courier->id, 'restaurant_id' => $restaurant->id]);
        Address::factory()->create(['id' => $order->address_id, 'latitude' => 35.7000, 'longitude' => 51.4000]);

        $response = $this->actingAs($user)->get('/courier/dashboard');

        $response->assertStatus(200)
                 ->assertSee('courier-map');
    }
}
