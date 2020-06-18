<?php

namespace Tests\Unit;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserResourceTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_collection_has_valid_structure()
    {
        $user = factory(User::class)->create();
        $userCollection  = new UserResource($user);

        $this->assertEquals($user->only('id', 'email', 'name'), $userCollection->resolve());
    }
}
