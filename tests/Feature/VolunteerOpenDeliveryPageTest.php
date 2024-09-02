<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VolunteerOpenDeliveryPageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testVolunteerLogin()
    {
        $this->get('/login');

        $this -> post('/login',[
            'email' => 'volunteerone@gmail.com',
            'password' => '123456',
        ]);
    }
    public function test_example()
    {
        $this->testVolunteerLogin();

        $response = $this->get('/volunteer/AllDeliveryForVolunteer');

        $response->assertStatus(200);
    }
}
