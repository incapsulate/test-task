<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function email_is_required_for_login()
    {
        $params = [
            'password' => 'test',
        ];

        $this->makeLogin($params);
        $this->assertValidationError('email');
    }

    /** @test */
    public function password_is_required_for_login()
    {
        $params = [
            'email'    => 'test@test.com',
        ];

        $this->makeLogin($params);
        $this->assertValidationError('password');
    }

    /** @test */
    public function user_cannot_login_with_invalid_credentials()
    {
        $params = [
            'email'    => 'invalida_email_value@test.com',
            'password' => 'invalid_password_value',
        ];

        $this->makeLogin($params);
        $this->assertResponseStatus(401);
    }

    /** @test */
    public function user_can_login()
    {
        $user = factory(User::class)->create([
            'name' => 'test',
            'email' => 'first_user@test.com',
            'password' => bcrypt('test'),
        ]);

        $this->makeLogin(['email' => 'first_user@test.com', 'password' => 'test']);
        $this->assertResponseStatus(200);
        $this->assertTrue(auth()->check());
        $this->assertTrue(auth()->user()->is($user));
        $this->assertTrue($this->response->headers->has('Authorization'));
    }

    private function makeLogin(array $params)
    {
        $this->response = $this->json('POST', "/api/v1/user/login", $params);
    }
}
