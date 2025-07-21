<?php

namespace Tests\Feature;

use App\Models\Restaurant;
use App\Models\MenuItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_filter_restaurants_by_category()
    {
        Restaurant::factory()->create(['category' => 'ایرانی']);
        Restaurant::factory()->create(['category' => 'فست‌فود']);

        $response = $this->get('/?category=ایرانی');

        $response->assertStatus(200)
                 ->assertViewHas('restaurants', function ($restaurants) {
                     return $restaurants->count() === 1 && $restaurants->first()->category === 'ایرانی';
                 });
    }

    public function test_can_filter_menu_items_by_category()
    {
        $restaurant = Restaurant::factory()->create();
        MenuItem::factory()->create(['restaurant_id' => $restaurant->id, 'category' => 'غذای ایرانی']);
        MenuItem::factory()->create(['restaurant_id' => $restaurant->id, 'category' => 'فست‌فود']);

        $response = $this->get("/restaurants/{$restaurant->id}?category=غذای ایرانی");

        $response->assertStatus(200)
                 ->assertViewHas('menuItems', function ($menuItems) {
                     return $menuItems->count() === 1 && $menuItems->first()->category === 'غذای ایرانی';
                 });
    }
}
