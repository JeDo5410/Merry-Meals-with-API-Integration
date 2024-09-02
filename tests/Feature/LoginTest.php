<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'gender' => '0',
            'age' => 33,
            'email' => 'test@test.com',
            'password' => bcrypt(($password = 'test123')),
            'phone' => '01234567',
            'address' => 'Malaysia',
            'geolocation' => '3.243001,101.6774092',
            'role' => 'member',
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}