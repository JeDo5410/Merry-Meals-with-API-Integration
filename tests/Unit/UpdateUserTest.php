<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateUserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function adminLogin()
    {
        $this->get('/login');

        $this->post('/login', [
            'email'    => 'admin@example.net',
            'password' => '12345678',
        ]);
    }
    use RefreshDatabase;
    public function test_create_user(){

        $user = User::create([
            'id' => 1,
            'name' => 'user1',
            'email'    => 'user1@example.net',
            'gender' => '1',
            'age' => '62',
            'address' => 'Where am I hehe',
            'geolocation' => '-8.690116547940254, 115.22790351696908',
            'phone' => '763787154',
            'password' => bcrypt('12345678'),
            'role' => 'member',
        ]);

        $member = Member::create([
            'user_id' => 1,
            'member_caregiver_name' => 'El Brose',
            'member_caregiver_relation' => 'Son',
            'member_medical_condition' => 'Nope',
            'member_medical_number' => '9823475921',
            'member_meal_duration' => '10',
        ]);

        $registeredUser = User::find($user);
        $registeredMember = Member::find($member);
        $this->assertNotNull($registeredUser, $registeredMember);
    }

    public function test_adminUpdatingUserInformation()
    {
        $this->adminLogin();

        $response = $this->post('/admin/userUpdated/2', [
            '_token' => csrf_token(),
            'id' => 2,
            "name" => 'El apdet',
        ]);

        $response->assertSessionHas('dataInform', 'Profile Has Been Updated Sucessfully!');
    }
}
