<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewAllUsersTest extends TestCase
{
    use RefreshDatabase;
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

    public function test_viewAllMembers()
    {
        $this->adminLogin();
        $response = $this->get('/admin/allMembers');

        $response->assertStatus(200);
    }

    public function test_viewAllPartners()
    {
        $this->adminLogin();
        $response = $this->get('/admin/allPartner');

        $response->assertStatus(200);
    }

    public function test_viewAllVolunteers()
    {
        $this->adminLogin();
        $response = $this->get('/admin/allVolunteers');

        $response->assertStatus(200);
    }
}
