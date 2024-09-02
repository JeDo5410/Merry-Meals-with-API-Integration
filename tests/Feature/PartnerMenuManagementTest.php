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

class PartnerMenuManagementTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function partnerLogin()
    {
        $this->get('/login');

        $this->post('/login', [
            'email'    => 'partner@gmail.com',
            'password' => '12345678',
        ]);
    }

    public function test_partnerUpdateSpecificMenu()
    {
        $this->partnerLogin();

        Storage::fake('local');
        $file = UploadedFile::fake()->create('Spaghetti.jpg');

        $response = $this->post('/partner/saveUpdate1', [
            '_token' => csrf_token(),
            'partner' => '1',
            'menu_title' => 'Italian Spaghetti',
            'menu_description' => 'Italian Spaghetti with Homemade Tomato Sauce',
            'menu_image' => $file,
        ]);

        $response->assertSessionHas('updateData', 'Menu Has Been Updated Sucessfully!');
    }

    public function test_partnerDeleteSpecificMenu()
    {
        $this->partnerLogin();

        $response = $this->get('/partner/deleteMenu/1');

        $response->assertSessionHas('menuDeleted', 'Menu Has Been Deleted Successfully!');
    }
}
