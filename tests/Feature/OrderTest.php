<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\CartItem;
use App\Models\MenuItem;
use App\Models\Address;
use App\Jobs\NotifyOrderStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Queue;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_order()
    {
        Queue::fake();

        $user = User::factory()->create(['role' => 'customer']);
        $menuItem = MenuItem::factory()->create();
        $cartItem = CartItem::factory()->create(['user_id' => $user->id, 'menu_item_id' => $menuItem->id]);
        $address = Address::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/orders', [
            'address_id' => $address->id,
        ]);

        $response->assertStatus(201)
                 ->assertJson(['user_id' => $user->id]);

        Queue::assertPushed(NotifyOrderStatus::class);
    }
}
