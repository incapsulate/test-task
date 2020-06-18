<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DashboardTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guest_cannot_view_dashboard()
    {
        $response = $this->getJson('/api/v1/user');
        $response->assertStatus(401);
    }

    /** @test */
    public function user_can_get_data()
    {
        $user = factory(User::class)->create();
        $token = $user->createToken('user')->accessToken;

        $this->response = $this->getJson('/api/v1/user', ['Authorization' => "Bearer {$token}"]);
        $this->assertResponseStatus(200);
        $responseUser = $this->decodeResponseJson()['data'];
        $this->assertEquals($user->only('id', 'name', 'email'), $responseUser);
    }

    /** @test */
    public function user_can_logout()
    {
        $user = factory(User::class)->create();
        $token = $user->createToken('user')->accessToken;

        $this->response = $this->postJson('/api/v1/user/logout', [], ['Authorization' => "Bearer {$token}"]);
        $this->assertResponseStatus(200);
    }
}
