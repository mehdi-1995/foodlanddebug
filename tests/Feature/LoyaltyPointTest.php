<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\LoyaltyPoint;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoyaltyPointTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_view_points()
    {
        $user = User::factory()->create(['role' => 'customer']);
        LoyaltyPoint::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/customer/points');

        $response->assertStatus(200)
            ->assertViewIs('customer.points')
            ->assertViewHas('points');
    }

    public function test_can_add_loyalty_points_via_api()
    {
        $user = User::factory()->create(['role' => 'customer']);
        $order = Order::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/loyalty-points', [
            'points' => 50,
            'source' => 'order',
            'order_id' => $order->id,
        ]);

        $response->assertStatus(201)
            ->assertJson(['points' => 50]);
    }
}
