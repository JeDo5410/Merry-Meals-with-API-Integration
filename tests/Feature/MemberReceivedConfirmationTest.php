<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MemberReceivedConfirmationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMemberLogin()
    {
        $this->get('/login');

        $this->post(
            '/login',
            [
                'email' => 'memberone@gmail.com',
                'password' => '123456',
            ]
        );
    }

    public function test_example()
    {
        $this->testMemberLogin();

        $response = $this->get('/member/updateMemberOrder/1');

        //$response->assertStatus(200);
        $response->assertRedirect('/member/showOrderDelivery/5');
    }
}