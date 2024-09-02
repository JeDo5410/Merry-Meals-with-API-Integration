<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Member;
use App\Models\Partner;
use App\Models\Menu;
use App\Models\Volunteer;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MemberOrderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;
    public function testCreateMember()
    {
        $user = User::factory()->create([
            'name' => 'Member1',
            'email'    => 'memberone@gmail.com',
            'gender' => '1',
            'age' => '22',
            'address' => 'Address Example',
            'geolocation' => '-8.690116547940255, 115.22790351696909',
            'phone' => '7637871',
            'password' => bcrypt('123456'),
            'role' => 'member',
        ]);

        $member = Member::create([
            'user_id' => '5',
            'member_caregiver_name' => 'CareGiver2',
            'member_caregiver_relation' => 'Son',
            'member_medical_condition' => 'NA',
            'member_medical_number' => '112233',
            'member_meal_type' => 'Hot',
            'member_meal_duration' => '30',
            'member_extends_reason' => 'NA',
        ]);
    }

    public function testCreatePartner()
    {
        $user = User::factory()->create([
            'name' => 'Partner',
            'email'    => 'partnerone@gmail.com',
            'gender' => '1',
            'age' => '22',
            'address' => 'Address Example',
            'geolocation' => '-8.690116547940255, 115.22790351696909',
            'phone' => '7637871',
            'password' => bcrypt('123456'),
            'role' => 'partner',
        ]);

        $partner = Partner::create([
            'user_id' => '6',
            'partnership_restaurant' => 'McDonald',
            'partnership_duration' => '2 Years',
            'partnership_address' => 'McDonaldAddress',
        ]);
    }

    public function testCreateVolunteer()
    {
        $user = User::factory()->create([
            'name' => 'Volunteer',
            'email'    => 'volunteerone@gmail.com',
            'gender' => '1',
            'age' => '22',
            'address' => 'Address Example',
            'geolocation' => '-8.690116547940255, 115.22790351696909',
            'phone' => '7637871',
            'password' => bcrypt('123456'),
            'role' => 'volunteer',
        ]);

        $partner = Volunteer::create([
            'user_id' => '7',
            'volunteer_vaccination' => '1',
            'volunteer_duration' => '1 year',
            'volunteer_available' => 'Sunday, Monday',
        ]);
    }

    public function testCreateMenu()
    {
        $menu = Menu::create([
            'partner_id' => '1',
            'menu_title' => 'Spaghetti',
            'menu_description' => 'Spaghetti Layered with Sauce',
            'menu_image' => 'Spaghetti_Image',
        ]);
    }

    public function memberLogin()
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

    public function test_()
    {
        $this->memberLogin();

        $response = $this->post('/member/saveOrder', [
            'member_name' => 'Member One',
            'member_address' => 'Adress Example',
            'member_phone' => '0812345678',
            'order_menu_image' => 'Spaghetti_Image',
            'order_menu_name' => 'Spaghetti',
            'order_menu_restaurant' => 'McDonald',
            'partner_address' => 'Adress Example',
            'partner_id' => 1,
            'partner_address' => 'test hehe',
            'member_id' => 1,
            'menu_id' => 1,
            'user_id' => 1,
            'menu_plan' => 29,
            'order_menu_type' => 'Hot',
        ]);

        $response->assertSessionHas('orderCreated', 'Your Order has been placed Sucessfully!');
    }
}
