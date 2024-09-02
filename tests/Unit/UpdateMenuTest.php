<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Menu;
use App\Models\User;
use App\Models\Member;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateMealsTest extends TestCase
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
    public function test_createMenu(){
        $menu = Menu::create([
            'id' => 1,
            'partner_id' => 1,
            'menu_title' => 'Spaghetti',
            'menu_description' => 'Spaghetti Layered with Sauce',
            'menu_image' => 'Spaghetti_Image',
        ]);

        $meals = Menu::find($menu);
        $this->assertNotNull($meals);
    }

    public function test_adminUpdateSpecificMenu()
    {
        $this->adminLogin();

        Storage::fake('local');
        $file = UploadedFile::fake()->create('Spaghetti.jpg');

        $response = $this->post('/admin/saveUpdateMenu/1', [
            '_token' => csrf_token(),
            'partner' => '1',
            'menu_title' => 'especialle espanyola menue',
            'menu_description' => 'The menu from Espanyola, Senporita!!',
            'menu_image' => $file,
        ]);

        $response->assertSessionHas('updateData', 'Menu Has Been Updated Sucessfully!');
    }

}
