<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Courier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourierDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_courier_can_access_dashboard()
    {
        $user = User::factory()->create(['role' => 'courier']);
        $courier = Courier::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/courier/dashboard');

        $response->assertStatus(200)
            ->assertViewIs('courier.dashboard')
            ->assertViewHas('courier', $courier);
    }

    public function test_non_courier_cannot_access_dashboard()
    {
        $user = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($user)->get('/courier/dashboard');

        $response->assertStatus(403);
    }
}
