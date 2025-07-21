<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\CartItem;
use App\Models\MenuItem;
use App\Models\Address;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_initiate_payment()
    {
        $user = User::factory()->create(['role' => 'customer']);
        $menuItem = MenuItem::factory()->create();
        $cartItem = CartItem::factory()->create(['user_id' => $user->id, 'menu_item_id' => $menuItem->id]);
        $address = Address::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/orders', [
            'address_id' => $address->id,
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(['order', 'payment_url']);
    }
}
