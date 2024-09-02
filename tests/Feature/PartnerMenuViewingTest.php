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

class PartnerMenuViewingTest extends TestCase
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

    public function test_partnerViewOwnMenu()
    {
        $this->partnerLogin();

        $response = $this->get('/partner');

        $response->assertViewHas('partnerData', function (Partner $partner) {
            return $partner->id == '2';
        });
    }
}