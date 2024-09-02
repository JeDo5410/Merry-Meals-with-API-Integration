<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    use RefreshDatabase;
    public function test_adminRegister()
    {
        $user = User::factory()->create([
            'name' => 'Admin1',
            'email'    => 'admin@example.net',
            'gender' => '1',
            'age' => '22',
            'address' => 'Where am I',
            'geolocation' => '-8.690116547940255, 115.22790351696909',
            'phone' => '7637871',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);
        $registered = User::find($user);
        $this->assertNotNull($registered);
    }
}
