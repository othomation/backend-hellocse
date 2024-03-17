<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthenticationApiTest extends TestCase
{
    /** @test */
    public function should_access_homepage_unauthenticated(): void
    {
        $response = $this->get(RouteServiceProvider::HOME);
        $response->assertStatus(200);
    }

    /** @test */
    public function should_access_user_detail_to_authenticated_user(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->get('/api/user');

        $response->assertStatus(200);
    }

    /** @test */
    public function should_not_access_user_route_unauthenticated(): void
    {
        $response = $this->get('/api/user');

        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Unauthenticated.'
        ]);
    }

    /** @test */
    public function should_get_token_at_login_route_with_correct_credentials(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('test')
        ]);

        $response = $this->post('/api/auth/login', [
            "email" => $user->email,
            "password" => "test"
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(["access_token", "token_type"]);
    }

    /** @test */
    public function should_get_invalid_credentials_on_login_route(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('test')
        ]);

        $response = $this->post('/api/auth/login', [
            "email" => $user->email,
            "password" => "not_the_good_password_obviously"
        ]);

        $response->assertStatus(401);
        $response->assertJson([
            "message" => "Invalid Credentials"
        ]);
    }
}
