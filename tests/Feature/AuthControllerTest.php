<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_with_valid_credentials()
    {
        $phone = '123456' . rand(1000, 9999);
        $user = User::factory()->create([
            'phone' => $phone,
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson('/api/login', [
            'phone' => $phone,
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'user' => ['id', 'phone', 'name', 'email', 'role'],
                     'token',
                 ]);
    }

    public function test_login_with_invalid_credentials()
    {
        $phone = '123456' . rand(1000, 9999);
        $user = User::factory()->create([
            'phone' => $phone,
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson('/api/login', [
            'phone' => $phone,
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401)
                 ->assertJson([
                     'message' => 'شماره موبایل یا رمز عبور اشتباه است',
                 ]);
    }
}
