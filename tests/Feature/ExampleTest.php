<?php

namespace Tests\Feature;

use App\User;
use App\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        // create a new user but do not store in DB
        $user = factory(User::class)->make(['user_role_id' => UserRole::ADMIN['id']]);

        $response = $this->actingAs($user)
            ->get('/resources/categories');
        $response->assertStatus(200);
    }
    
}
