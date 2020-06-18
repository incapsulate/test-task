<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('passport:install');
    }

    protected function assertResponseStatus($status)
    {
        $this->response->assertStatus($status);
    }

    protected function decodeResponseJson()
    {
        return $this->response->decodeResponseJson();
    }

    protected function assertValidationError($field)
    {
        $this->assertResponseStatus(422);
        $this->assertTrue((bool)strpos($this->decodeResponseJson()['error'], $field));
    }
}
