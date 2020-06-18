<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function name_is_required_for_registration()
    {
        $params = [
            'email'    => 'test@test.com',
            'password' => 'test',
        ];

        $this->makeRegistration($params);
        $this->assertValidationError('name');
    }

    /** @test */
    public function email_is_required_for_registration()
    {
        $params = [
            'name'     => 'test',
            'password' => 'test',
        ];

        $this->makeRegistration($params);
        $this->assertValidationError('email');
    }

    /** @test */
    public function email_must_be_valid_for_registration()
    {
        $params = [
            'name'     => 'test',
            'email'    => 'some_invalid_email',
            'password' => 'test',
        ];

        $this->makeRegistration($params);
        $this->assertValidationError('email');
    }

    /** @test */
    public function password_is_required_for_registration()
    {
        $params = [
            'name'     => 'test',
            'email'    => 'test@test.com',
        ];

        $this->makeRegistration($params);
        $this->assertValidationError('password');
    }

    /** @test */
    public function user_can_register()
    {
        $params = [
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => 'test',
        ];

        $this->makeRegistration($params);
        $this->assertResponseStatus(200);
        $this->assertDatabaseHas('users', ['email' => 'test@test.com']);
        $this->assertTrue($this->response->headers->has('Authorization'));
    }

    private function makeRegistration(array $params)
    {
        $this->response = $this->json('POST', "/api/v1/user/register", $params);
    }
}
