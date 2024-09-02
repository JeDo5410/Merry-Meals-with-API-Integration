<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Member;
use Database\Factories\MemberFactory;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function test_member_can_register()
    {

        $response = $this->post('/register', [
            'name' => 'Joe Smith',
            'gender' => '0',
            'age' => 33,
            'email' => 'testemail@test.com',
            'password' => 'joe12345',
            'password_confirmation' => 'joe12345',
            'phone' => '01234567',
            'address' => 'Malaysia',
            'geolocation' => '3.243001,101.6774092',
            'role' => 'member',
            'member_caregiver_name' => 'Andy',
            'member_caregiver_relation' => 'son',
            'member_medical_condition' => 'disability',
            'member_medical_number' => "4343634363",
            'member_meal_duration' => 30,
            'reassessment_status' => '',
            'service_eligibility' => 'disease',
            'dietary' => 'Regular',
        ]);


        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_partner_can_register()
    {

        $response = $this->post('/register', [
            'name' => 'Jane Smith',
            'gender' => '1',
            'age' => 40,
            'email' => 'testpartner@test.com',
            'password' => 'joe12345',
            'password_confirmation' => 'joe12345',
            'phone' => '01234567',
            'address' => 'Malaysia',
            'geolocation' => '3.256210908558588, 101.65628061256466',
            'role' => 'partner',
            'partnership_restaurant' => 'MerryBrown',
            'partnership_duration' => '1 Year',
            'partnership_address' => 'Malaysia',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_volunteer_can_register()
    {

        $response = $this->post('/register', [
            'name' => 'Dana Smith',
            'gender' => '1',
            'age' => 40,
            'email' => 'testvolunteer@test.com',
            'password' => 'joe12345',
            'password_confirmation' => 'joe12345',
            'phone' => '01234567',
            'address' => 'Malaysia',
            'geolocation' => '3.256210908558588, 101.65628061256466',
            'role' => 'volunteer',
            'volunteer_vaccination' => '1',
            'volunteer_duration' => '1 Year',
            'volunteer_available' => ['Monday, Saturday'],
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}