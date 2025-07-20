<?php

namespace Tests\Unit;

use App\Models\CartItem;
use App\Models\User;
use App\Models\MenuItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_add_item_to_cart()
    {
        $user = User::factory()->create();
        $menuItem = MenuItem::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/cart', [
            'menu_item_id' => $menuItem->id,
            'quantity' => 2,
        ]);

        $response->assertStatus(201)
            ->assertJson(['menu_item_id' => $menuItem->id]);
    }

    public function test_can_list_cart_items()
    {
        $user = User::factory()->create();
        CartItem::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/cart');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_can_remove_cart_item()
    {
        $user = User::factory()->create();
        $cartItem = CartItem::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user, 'sanctum')->deleteJson("/api/cart/{$cartItem->id}");

        $response->assertStatus(204);
    }
}
