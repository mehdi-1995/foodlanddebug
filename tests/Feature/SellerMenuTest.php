<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\MenuItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SellerMenuTest extends TestCase
{
    use RefreshDatabase;

    public function test_seller_can_view_menu_items()
    {
        $user = User::factory()->create(['role' => 'seller']);
        $restaurant = Restaurant::factory()->create(['user_id' => $user->id]);
        MenuItem::factory()->count(3)->create(['restaurant_id' => $restaurant->id]);

        $response = $this->actingAs($user)->get('/seller/menu');

        $response->assertStatus(200)
                 ->assertViewIs('seller.menu.index')
                 ->assertViewHas('menuItems');
    }

    public function test_seller_can_create_menu_item()
    {
        $user = User::factory()->create(['role' => 'seller']);
        $restaurant = Restaurant::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post('/seller/menu', [
            'name' => 'کباب',
            'description' => 'کباب کوبیده سنتی',
            'price' => 100000,
            'category' => 'غذای ایرانی',
            'image' => 'https://via.placeholder.com/300x150',
        ]);

        $response->assertRedirect('/seller/menu')
                 ->assertSessionHas('success');
    }

    public function test_seller_can_update_menu_item()
    {
        $user = User::factory()->create(['role' => 'seller']);
        $restaurant = Restaurant::factory()->create(['user_id' => $user->id]);
        $menuItem = MenuItem::factory()->create(['restaurant_id' => $restaurant->id]);

        $response = $this->actingAs($user)->put("/seller/menu/{$menuItem->id}", [
            'name' => 'کباب به‌روزرسانی‌شده',
            'description' => 'کباب کوبیده ویژه',
            'price' => 120000,
            'category' => 'غذای ایرانی',
            'image' => 'https://via.placeholder.com/300x150',
        ]);

        $response->assertRedirect('/seller/menu')
                 ->assertSessionHas('success');
    }

    public function test_seller_can_delete_menu_item()
    {
        $user = User::factory()->create(['role' => 'seller']);
        $restaurant = Restaurant::factory()->create(['user_id' => $user->id]);
        $menuItem = MenuItem::factory()->create(['restaurant_id' => $restaurant->id]);

        $response = $this->actingAs($user)->delete("/seller/menu/{$menuItem->id}");

        $response->assertRedirect('/seller/menu')
                 ->assertSessionHas('success');
    }
}
