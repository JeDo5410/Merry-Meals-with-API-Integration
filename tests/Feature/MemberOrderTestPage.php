<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MemberOrderPageTest extends TestCase
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

    public function testOpenOrderPage()
    {
        $this->testMemberLogin();

        $response = $this->get('/member/showOrderDelivery/5');

        $response->assertStatus(200);
    }

    public function test_saveReceivedConfirmation()
    {
        $this->testMemberLogin();

        $response = $this->get('/member/updateMemberOrder/1');

        $response->assertRedirect('/member/showOrderDelivery/5');
    }
}