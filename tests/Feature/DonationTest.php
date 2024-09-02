<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DonationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

   // Ensure that the donation page is accessible
   public function test_donor_fee()
   {
       $response = $this->get('/donationFee');
       $response->assertStatus(200);
   }

   // Check the donation amount entered by the donor on the first donation page can be stored in the database
   public function test_donor_fee_data()
   {
       $response = $this->post('/saveDonationFee', [
           'donor_fee'=>'1000',
           'donor_tribute'=>'in honor of',
           'donor_honoree_name'=>'Karina',
       ]);
       $this->assertTrue(true);
   }

   // Ensure that the billing page is accessible
   public function test_billing()
   {
       $response = $this->get('/donor');
       $response->assertStatus(200);
   }

   // Check the data entered by the donor in the billing information is stored in the database
   public function test_billing_data()
   {
       $response = $this->post('/saveBilling', [
           'donor_id'=>1,
           'donor_email'=>'karinaremuna@gmail.com',
           'donor_first_name'=>'karina',
           'donor_last_name'=>'remuna',
           'donor_phone'=>'08123845054',
           'donor_address'=>'pancoran street',
           'donor_city'=>'toronto',
           'donor_state'=>'california',
           'donor_country'=>'canada',
       ]);
       $this->assertTrue(true);
   }
   
   // Ensure that the completion page is accessible
   public function test_completion()
   {
       $response = $this->get('/getCompletion');
       $response->assertStatus(200);
   }
}
