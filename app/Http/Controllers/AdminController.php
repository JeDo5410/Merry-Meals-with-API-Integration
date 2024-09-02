<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\User;
use App\Models\Donor;
use App\Models\Order;
use App\Models\Member;
use App\Models\Partner;
use App\Models\DonorFee;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Log;


class AdminController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Users.Admin.adminIndex');
    }

    public function allMembers()
    {
        $memberData = Member::get();
        return view('Users.Admin.allMembers')->with('memberData', $memberData);
    }

    //All Partners
    public function allPartners(){
        $partnerData = Partner::get();
        return view('Users.Admin.allPartners')->with('partnerData', $partnerData);
    }

    //All Volunteers
    public function allVolunteers(){
        $volunteerData = Volunteer::get();
        return view('Users.Admin.allVolunteers')->with('volunteerData', $volunteerData);
    }

    //All Menus
    public function allMenus(){
        $menuData = Menu::all();
        return view('Users.Admin.allMenus')->with(['menuData' => $menuData]);
    }

    //All Donors
    public function allDonors(){
        $donorData = Donor::get();
        $feeData = DonorFee::get();
        $totalDonate = DB::table('donor_fees')->sum('donor_fee');
        return view('Users.Admin.allDonors')->with([
            'donorData' => $donorData,
            'feeData' => $feeData,
            'totalDonate' => $totalDonate,
            ]);
    }

    //All Deliveries
    public function allDeliveries(){
        //show all order partner need to start cooking for
        $order_data = Order::get();

        return view('Users.Admin.allDeliveries')->with([
            'orderData' => $order_data,
        ]);
    }

    //Delete Menu
    public function deleteMenu($id)
    {
        $deleteData = Menu::select('menu_image')->where('id', $id)->first();
        $deleteImage = $deleteData['menu_image'];

        Menu::where('id', $id)->delete();

        if (File::exists(public_path() . '/uploads/meal/' . $deleteImage)) {
            File::delete(public_path() . '/uploads/meal/' . $deleteImage);
        }

        return redirect()->route('admin#allMenus')->with(['menuDeleted' => 'Menu Has Been Deleted Successfully!']);
    }

    //Update Menu
    public function updateMenu($id)
    {
        $partner_data =  Partner::get();
        $user_data = User::get();
        $updateMenu = Menu::where('id', $id)
            ->first();
        return view('Users.Admin.updateMenu')->with(['updateMenu' => $updateMenu, 'userData' => $user_data, 'partnerData' => $partner_data]);
    }
    public function saveUpdateMenu(Request $request, $id)
    {
        $updateData = $this->requestUpdateMenuData($request);

        $updateImgData = Menu::select('menu_image')->where('id', $id)->first();
        $updateImage = $updateImgData['menu_image'];

        if (File::exists(public_path() . '/uploads/meal/' . $updateImage)) {
            File::delete(public_path() . '/uploads/meal/' . $updateImage);
        }

        $newImageFile = $request->file('menu_image');
        $newImageName = uniqid() . '_' . $newImageFile->getClientOriginalName();
        $newImageFile->move(public_path() . './uploads/meal/', $newImageName);

        $updateData['menu_image'] = $newImageName;

        Menu::where('id', $id)->update($updateData);
        return redirect()->route('admin#allMenus')->with(['updateData' => 'Menu Has Been Updated Sucessfully!']);
    }
    private function requestUpdateMenuData($request)
    {
        $menuArray = [
            'menu_title' => $request->menu_title,
            'menu_description' => $request->menu_description,
            'menu_allergens' => $request->menu_allergens,
            'menu_nutritions' => $request->menu_nutritions,
            'partner_id' => $request->partner,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        if (isset($request->menu_image)) {
            $menuArray['menu_image'] = $request->menu_image;
        }

        return $menuArray;
    }

    //Delete Member
    public function deleteMember($id){
        Member::where('user_id', $id)->delete();
        User::where('id', $id)->delete();
        return back()->with(['dataInform' => 'Member Has Been Deleted Successfully!']);
    }

    //Delete Partner
    public function deletePartner($id){
        Partner::where('user_id', $id)->delete();
        User::where('id', $id)->delete();
        return back()->with(['dataInform' => 'Partner Has Been Deleted Successfully!']);
    }

    //Delete Volunteer
    public function deleteVolunteer($id){
        Volunteer::where('user_id', $id)->delete();
        User::where('id', $id)->delete();
        return back()->with(['dataInform' => 'Volunteer Has Been Deleted Successfully!']);
    }

    //Get Update Member
    public function updateMembers($user_id){
        $memberData = Member::where('user_id', $user_id)->First();
        $userData = User::where('id', $user_id)->First();

        return view('Users.Admin.updateMember')->with(['memberData' => $memberData, 'userData' => $userData, ]);
    }

    //Get Update Partner
    public function updatePartner($user_id){
        $partnerData = Partner::where('user_id', $user_id)->First();
        $userData = User::where('id', $user_id)->First();

        return view('Users.Admin.updatePartner')->with(['partnerData' => $partnerData, 'userData' => $userData, ]);
    }

    //Get Update Volunteer
    public function updateVolunteer($user_id){
        $volunteerData = Volunteer::where('user_id', $user_id)->First();
        $userData = User::where('id', $user_id)->First();

        return view('Users.Admin.updateVolunteer')->with(['volunteerData' => $volunteerData, 'userData' => $userData, ]);
    }

    //Get Update Admin
    public function updateAdmin($user_id){
        $userData = User::where('id', $user_id)->First();

        return view('Users.Admin.updateAdmin')->with(['userData' => $userData, ]);
    }

    //Save Update User
    public function saveUpdateUser(Request $request, $id){
        $updateData = $this->requestUpdateUserData($request);
        User::where('id', $id)->update($updateData);

        return back()->with(['dataInform' => 'Profile Has Been Updated Sucessfully!']);
    }

    private function requestUpdateUserData($request){
        $arr = [
            'name' => $request->name,
            'gender'=> $request->gender,
            'age'=> $request->age,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $arr;
    }

    //Save Update Member
    public function saveUpdateM(Request $request, $user_id){
        $updateMember = $this->requestUpdateMember($request);
        Member::where('user_id', $user_id)->update($updateMember);

        return back()->with(['dataInform' => 'Profile Has Been Updated Sucessfully!']);

    }

    private function requestUpdateMember($request){
        $arr = [
            'service_eligibility' => $request-> service_eligibility,
            'dietary'=> $request->dietary,
            'member_meal_type' => $request->member_meal_type,
            'member_meal_duration' => $request->member_meal_duration,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $arr;
    }

    //Save Update Partner
    public function saveUpdateP(Request $request, $user_id){

        Log::info('Received request for update:', $request->all());

        $updatePartner = $this->requestUpdatePartner($request);
        Partner::where('id', $user_id)->update($updatePartner);

        Log::info('Prepared update data:', $updatePartner);

        // return back()->with(['dataInform' => 'Profile Has Been Updated Sucessfully!']);

        $updated = Partner::where('user_id', $user_id)->update($updatePartner);

        Log::info('Update status:', ['updated' => $updated]);

        // Check if the update was successful
        if ($updated) {
            return back()->with(['dataInform' => 'Profile Has Been Updated Successfully!']);
        } else {
            return back()->withErrors(['msg' => 'Profile Update Failed!']);
        }
    }

    private function requestUpdatePartner($request){
        $arr = [
            'partnership_restaurant' => $request-> partnership_restaurant,
            'partnership_duration'=> $request-> partnership_duration,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $arr;
    }

    //Save Update Volunteer
    public function saveUpdateV(Request $request, $user_id){
        Log::info('Received request for update:', $request->all());

        $updateVolunteer = $this->requestUpdateVolunteer($request);
        Volunteer::where('id', $user_id)->update($updateVolunteer);

        Log::info('Prepared update data:', $updateVolunteer);

        // return back()->with(['dataInform' => 'Profile Has Been Updated Sucessfully!']);

        $updated = Volunteer::where('user_id', $user_id)->update($updateVolunteer);

        Log::info('Update status:', ['updated' => $updated]);

        // Check if the update was successful
        if ($updated) {
            return back()->with(['dataInform' => 'Profile Has Been Updated Successfully!']);
        } else {
            return back()->withErrors(['msg' => 'Profile Update Failed!']);
        }
    }

    private function requestUpdateVolunteer($request){
        $arr = [
            'volunteer_vaccination' => $request-> volunteer_vaccination,
            'volunteer_duration'=> $request->volunteer_duration,
            'volunteer_available' => $request->volunteer_available,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return $arr;
    }

    public function reviewReassessment(Request $request, $id)
    {
        $member = Member::findOrFail($id);
        $member->reassessment_status = $request->decision;
    
        if ($request->decision === 'approved') {
            $member->member_meal_duration += 30; // Add 30 days to the meal duration
            $message = 'Reassessment approved. 30 days added to meal duration.';
        } else {
            $message = 'Reassessment rejected.';
        }
    
        // Clear the extend reason after processing
        $member->member_extends_reason = null;
    
        $member->save();
    
        return redirect()->back()->with('dataInform', $message);
    }

    //GET UPDATE PROFILE
    public function updateProfile($user_id){

        $userData = User::where('id', $user_id)->First();

        return view('Users.Admin.updateAdmin')->with(['userData' => $userData, ]);
    }
}
