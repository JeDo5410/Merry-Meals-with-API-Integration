<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ViewAllMenusTest extends TestCase
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

    public function test_viewAllMenus()
    {
        $this->adminLogin();
        $response = $this->get('/admin/allMenus');

        $response->assertStatus(200);
    }

    public function memberLogin()
    {
        $this->get('/login');

        $this->post('/login', [
            'email'    => 'member@gmail.com',
            'password' => '12345678',
        ]);
    }

    public function test_memberViewAllMenuPage()
        {
            $this->memberLogin();

            $response = $this->get('/member/viewAllMenu');

            $response->assertStatus(200);
        }
}
