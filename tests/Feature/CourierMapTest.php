<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Courier;
use App\Models\Order;
use App\Models\Address;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourierMapTest extends TestCase
{
    use RefreshDatabase;

    public function test_courier_dashboard_loads_map_component()
    {
        $user = User::factory()->create(['role' => 'courier']);
        $courier = Courier::factory()->create(['user_id' => $user->id]);
        $order = Order::factory()->create(['courier_id' => $courier->id]);
        Address::factory()->create(['id' => $order->address_id, 'latitude' => 35.6892, 'longitude' => 51.3890]);

        $response = $this->actingAs($user)->get('/courier/dashboard');

        $response->assertStatus(200)
                 ->assertSee('courier-map');
    }
}
