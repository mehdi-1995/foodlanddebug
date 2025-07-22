<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_submit_review()
    {
        $user = User::factory()->create();
        $restaurant = Restaurant::factory()->create();

        $response = $this->actingAs($user)->post(route('reviews.store', $restaurant->id), [
            'rating' => 4,
            'comment' => 'غذای عالی و سرویس خوب!',
        ]);

        $response->assertRedirect(route('restaurants.show', $restaurant->id));
        $this->assertDatabaseHas('reviews', [
            'user_id' => $user->id,
            'restaurant_id' => $restaurant->id,
            'rating' => 4,
            'comment' => 'غذای عالی و سرویس خوب!',
        ]);
    }

    public function test_guest_cannot_submit_review()
    {
        $restaurant = Restaurant::factory()->create();

        $response = $this->post(route('reviews.store', $restaurant->id), [
            'rating' => 4,
            'comment' => 'غذای عالی!',
        ]);

        $response->assertRedirect(route('login'));
    }
}
