<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;
use App\Models\DonorFee;
use Stripe;
use Session;

class DonationController extends Controller
{

    public function saveDonationFee(Request $req)
    {
        // Validate the incoming request data
        $validatedData = $req->validate([
            'donor_fee' => 'required|numeric|min:1',
            'donor_tribute' => 'required|string',
            'donor_honoree_name' => 'required|string',
        ]);

        try {
            $donationFee = new DonorFee();
            $donationFee->donor_fee = $validatedData['donor_fee'];
            $donationFee->donor_tribute = $validatedData['donor_tribute'];
            $donationFee->donor_honoree_name = $validatedData['donor_honoree_name'];
            $donationFee->save();

            // If save is successful, redirect to the billing page
            return view('donation.billing');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error saving donation: ' . $e->getMessage());

            // Redirect back with an error message
            return back()->withInput()->with('error', 'There was an error processing your donation. Please try again.');
        }
    }
    public function donor(){
        return view('donation.billing');
    }

    // save billing 
    public function saveBilling(Request $req)
    {
        $billing = new Donor();
        $billing->donor_first_name = $req->input('donor_first_name');
        $billing->donor_last_name = $req->input('donor_last_name');
        $billing->donor_email = $req->input('donor_email');
        $billing->donor_phone = $req->input('donor_phone');
        $billing->donor_address = $req->input('donor_address');
        $billing->donor_city = $req->input('donor_city');
        $billing->donor_state = $req->input('donor_state');
        $billing->donor_country = $req->input('donor_country');
        $billing->save();
        return view('donation.payment');
    }

    // stripe
    public function stripe()
    {
        return view('donation.payment');
    }

    // post stripe
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "This payment is tested purpose"
            ]); 
            Session::flash('success','Payment Successful!');
            return view('donation.completion');
        }

    // get completion 
    public function getCompletion()
    {
        return view('donation.completion');
    }

    public function index()
    {
        return view('donation.donor');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}