<?php

namespace Tests\Feature;

use App\Http\Controllers\Controller;
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
        $user = factory(User::class)->create(['user_role_id' => UserRole::ADMIN['id']]);
        // $user = factory(User::class)->create(['user_role_id' => 2]);


        $response = $this->actingAs($user)
            ->get('/resources/categories');
        $response->assertStatus(200);
    }
    
}
