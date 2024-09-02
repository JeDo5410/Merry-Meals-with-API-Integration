<?php

namespace Tests\Feature;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\User;
use App\Models\Partner;
use App\Models\Member;
use App\Models\Volunteer;
use App\Models\Menu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class PartnerConfirmationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    //  use RefreshDatabase;

    public function testPartnerLogin()
    {
        $this->get('/login');

        $this->post(
            '/login',
            [
                'email'    => 'partnerone@gmail.com',
                'password' => '123456',
            ]
        );
    }

    public function test_example()
    {

        $this->testPartnerLogin();

        $response = $this->get(
            '/partner/updateOrder/1',
            [
                'id' => 1,
                'start_cooking_time' => Carbon::now()->timestamp,
            ]
        );

        // $this->assertTrue($response->id == '1');
        // $response->assertStatus(200);
        // $response->assertSessionHas('orderData');

        // $response->assertViewHas('orderData', function (Order $order) {
        //     return $order->start_cooking_time == "2022-10-17 22:08:43";
        // });

        $response->assertRedirect('/partner/AllOrderForPartner/6');
    }
}
