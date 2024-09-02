<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Deliver;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $volunteerData = Volunteer::where('user_id', Auth::id())->first();
    $deliveryData = Deliver::where('volunteer_id', Auth::id())->get();
    return view('Users.Volunteer.volunteerIndex')
        ->with(['volunteerData' => $volunteerData, 'deliveryData' => $deliveryData]);
}

    public function viewAllMenu()
    {
        $menuData = Menu::all();
        return view('Users.Volunteer.memberMenu')->with(['menuData' => $menuData]);
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

    //GET UPDATE PROFILE
    public function updateProfile($user_id){
        $volunteerData = Volunteer::where('user_id', $user_id)->First();
        $userData = User::where('id', $user_id)->First();

        return view('Users.Volunteer.updateVolunteer2')->with(['volunteerData' => $volunteerData, 'userData' => $userData, ]);
    }
}