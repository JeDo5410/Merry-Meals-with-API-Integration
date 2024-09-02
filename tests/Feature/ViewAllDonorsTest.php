<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ViewAllDonorsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function adminLogin()
    {
        $this->get('/login');

        $this->post('/login', [
            'email'    => 'admin@example.net',
            'password' => '12345678',
        ]);
    }

    public function test_viewAllDonorsTest()
    {
        $this->adminLogin();
        $response = $this->get('/admin/allDonors');

        $response->assertStatus(200);
    }
}
