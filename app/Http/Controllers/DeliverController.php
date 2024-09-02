<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Deliver;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function AllDeliveryForVolunteer()
    {
        //show all delivery volunteer need to send
        $deliver_data = Deliver::all();
        return view('Users.Volunteer.volunteerOrderDelivery')->with([
            'deliveryData' => $deliver_data,
        ]);
    }

    public function updateDelivery(Request $request, $id)
    {
        //find selected delivery
        $deliver_selected = Deliver::where('id', $id)->first();

        //save selected delivery
        $date = Carbon::now();
        if ($deliver_selected->start_deliver_time == null) {
            $deliver_selected->start_deliver_time = $date;
        }
        if ($deliver_selected->volunteer_id == null) {
            //find the volunteer user data
            // get name of volunteer fom user table
            $volunteer_user_data = User::where('id', Auth::id())->first();
            // get volunteer id from volunteer table
            $volunteer_data = Volunteer::where('user_id', Auth::id())->first();
            $deliver_selected->volunteer_name = $volunteer_user_data->name;
            $deliver_selected->volunteer_id = $volunteer_data->id;
        }
        $deliver_selected->delivery_status = $request->input('delivery_status');
        $deliver_selected->save();

        return redirect()->route('deliver#AllDeliveryForVolunteer');
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