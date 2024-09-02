<?php

namespace Tests\Feature;

use App\Models\Menu;
use App\Models\User;
use App\Models\Member;
use App\Models\Partner;
use App\Providers\RouteServiceProvider;
use GuzzleHttp\Promise\Create;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MemberMenuViewingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;
    public function test_memberRegister()
    {
        $user = User::factory()->create([
            'name' => 'Member1',
            'email'    => 'member@gmail.com',
            'gender' => '0',
            'age' => '22',
            'address' => 'Address Example',
            'geolocation' => '-8.690116547940255, 115.22790351696909',
            'phone' => '7637871',
            'password' => bcrypt('12345678'),
            'role' => 'member',
        ]);

        $member = Member::create([
            'user_id' => '4',
            'member_caregiver_name' => 'CareGiver1',
            'member_caregiver_relation' => 'Son',
            'member_medical_condition' => 'NA',
            'member_medical_number' => '112233',
            'member_meal_type' => 'Hot',
            'member_meal_duration' => '30',
            'member_extends_reason' => 'NA',
        ]);

        $this->assertTrue($member->member_caregiver_name == 'CareGiver1');
    }

    // public function memberLogin()
    // {
    //     $this->get('/login');

    //     $this->post('/login', [
    //         'email'    => 'member@gmail.com',
    //         'password' => '12345678',
    //     ]);
    // }

    // public function test_memberViewAllMenuPage()
    //     {
    //         $this->memberLogin();

    // //         $response = $this->get('/member/viewAllMenu');

    // //         $response->assertStatus(200);
    // //     }
}