<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Courier;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Address;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourierOrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_courier_can_view_orders()
    {
        $user = User::factory()->create(['role' => 'courier']);
        $courier = Courier::factory()->create(['user_id' => $user->id]);
        $order = Order::factory()->create(['courier_id' => $courier->id]);

        $response = $this->actingAs($user, 'sanctum')->get('/api/courier-orders');

        $response->assertStatus(200)
            ->assertJsonCount(1);
    }

    public function test_courier_can_update_order_status()
    {
        $user = User::factory()->create(['role' => 'courier']);
        $courier = Courier::factory()->create(['user_id' => $user->id]);
        $order = Order::factory()->create(['courier_id' => $courier->id]);

        $response = $this->actingAs($user, 'sanctum')->put("/api/courier-orders/{$order->id}", [
            'status' => 'shipped',
        ]);

        $response->assertStatus(200)
            ->assertJson(['status' => 'shipped']);
    }
}
