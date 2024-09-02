<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_show_register()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_show_login()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}