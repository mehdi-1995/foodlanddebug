<?php

namespace Tests\Feature;

use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_search_restaurants_by_name()
    {
        Restaurant::factory()->create(['name' => 'رستوران پارسی']);
        Restaurant::factory()->create(['name' => 'کافه ایتالیایی']);

        $response = $this->get('/?search=پارسی');

        $response->assertStatus(200)
                 ->assertViewHas('restaurants', function ($restaurants) {
                     return $restaurants->count() === 1 && $restaurants->first()->name === 'رستوران پارسی';
                 });
    }

    public function test_can_search_restaurants_by_address()
    {
        Restaurant::factory()->create(['address' => 'تهران، ولیعصر']);
        Restaurant::factory()->create(['address' => 'تهران، انقلاب']);

        $response = $this->get('/?search=ولیعصر');

        $response->assertStatus(200)
                 ->assertViewHas('restaurants', function ($restaurants) {
                     return $restaurants->count() === 1 && $restaurants->first()->address === 'تهران، ولیعصر';
                 });
    }
}
