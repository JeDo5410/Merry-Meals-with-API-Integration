<?php

namespace Tests\Feature;

use App\Models\Menu;
use App\Models\User;
use App\Models\Member;
use App\Models\Partner;
use GuzzleHttp\Promise\Create;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MenuCreatingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;
    public function test_partnerRegister()
    {
        $user = User::factory()->create([
            'name' => 'Partner1',
            'email'    => 'partner@gmail.com',
            'gender' => '1',
            'age' => '22',
            'address' => 'Address Example',
            'geolocation' => '-8.690116547940255, 115.22790351696909',
            'phone' => '7637871',
            'password' => bcrypt('12345678'),
            'role' => 'partner',
        ]);

        $partner = Partner::create([
            'user_id' => '8',
            'partnership_restaurant' => 'McDonald',
            'partnership_duration' => '2 Years',
            //'partnership_address' => 'McDonaldAddress',
        ]);

        $this->assertTrue($partner->partnership_restaurant == 'McDonald');
    }

    public function partnerLogin()
    {
        $this->get('/login');

        $this->post('/login', [
            'email'    => 'partner@gmail.com',
            'password' => '12345678',
        ]);
    }

    public function test_saveMenu()
    {
        $this->partnerLogin();

        Storage::fake('local');
        $file = UploadedFile::fake()->create('MeatBall.jpg');

        $response = $this->post('/partner/saveMenu', [
            '_token' => csrf_token(),
            'partner' => '1',
            'menu_title' => 'Meatball',
            'menu_description' => 'Homemade Chicken Meatball',
            'menu_image' => $file,
            'menu_allergens' => 'Soy beans',
            'menu_nutritions' => 'Protein',
            'ingredients' => 'Chicken and Meatballs',
            'expiry_date' => '2024-07-23',
            'safety_training' => 'yes',
            'separate_storage' => 'yes'
        ]);

        $response->assertSessionHas('menuCreated', 'Menu Has Been Created Sucessfully!');
    }
}