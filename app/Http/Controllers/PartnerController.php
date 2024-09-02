<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Partner;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partnerData = Partner::where('user_id', Auth::id())->first();
        $menuData = Menu::all()->where('partner_id',$partnerData->id);
        return view('Users.Partner.partnerIndex')->with(['menuData' => $menuData, 'partnerData' => $partnerData]);
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
    public function createMenu()
    {
        $partner_data = Partner::where('user_id', Auth::id())->first();
        $user_data = User::get();
        return view('Users.Partner.partnerMenuCreate')->with(['partnerData' => $partner_data, 'userData' => $user_data]);
    }
    public function saveMenu(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_title' => 'required',
            'menu_description' => 'required',
            'menu_image' => 'required',
            'menu_allergens' => 'required',
            'menu_nutritions' => 'required',
            'ingredients' => 'required',
            'safety_training' => 'required',
            'expiry_date' => 'required',
            'separate_storage' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $menu = new Menu();

        if ($request->hasfile('menu_image')) {

            $imageFile = $request->file('menu_image');
            $imageName = uniqid() . '_' . $imageFile->getClientOriginalName();
            $imageFile->move(public_path('./uploads/meal'), $imageName);

            $menu->menu_image = $imageName;
        }

        $menu->menu_title = $request->input('menu_title');
        $menu->menu_description = $request->input('menu_description');
        $menu->menu_allergens = $request->input('menu_allergens');
        $menu->menu_nutritions = $request->input('menu_nutritions');
        $menu->ingredients = $request->input('ingredients');
        $menu->safety_training = $request->input('safety_training');
        $menu->expiry_date = $request->input('expiry_date');
        $menu->separate_storage = $request->input('separate_storage');

        $menu->partner_id = $request->input('partner');
        $menu->save();
        return redirect()->route('partner#index')->with(['menuCreated' => 'Menu Has Been Created Sucessfully!']);
    }
    public function viewMenu($id)
    {
        $partner_data =  Partner::get();
        $user_data = User::get();
        $viewMenu = Menu::where('id', $id)
            ->first();
        return view('Users.Partner.partnerMenuDetails')->with([
            'viewMenu' => $viewMenu,
            'userData' => $user_data,
            'partnerData' => $partner_data,
        ]);
    }
    public function foodSafety()
    {
        return view('Users.Partner.foodSafetyDeclaration');
    }
    public function deleteMenu($id)
    {
        $deleteData = Menu::select('menu_image')->where('id', $id)->first();
        $deleteImage = $deleteData['menu_image'];

        Menu::where('id', $id)->delete();

        if (File::exists(public_path() . '/uploads/meal/' . $deleteImage)) {
            File::delete(public_path() . '/uploads/meal/' . $deleteImage);
        }

        return redirect()->route('partner#index')->with(['menuDeleted' => 'Menu Has Been Deleted Successfully!']);
    }
    public function updateMenu($id)
    {
        $partner_data = Partner::where('user_id', Auth::id())->first();
        $user_data = User::get();
        $updateMenu = Menu::where('id', $id)
            ->first();
        return view('Users.Partner.partnerUpdateMenu')->with(['updateMenu' => $updateMenu, 'userData' => $user_data, 'partnerData' => $partner_data]);
    }
    public function saveUpdate(Request $request, $id)
    {
        $updateData = $this->requestUpdateMenuData($request);

        $updateImgData = Menu::select('menu_image')->where('id', $id)->first();
        $updateImage = $updateImgData['menu_image'];

        if (File::exists(public_path() . '/uploads/meal/' . $updateImage)) {
            File::delete(public_path() . '/uploads/meal/' . $updateImage);
        }

        $newImageFile = $request->file('menu_image');
        $newImageName = uniqid() . '_' . $newImageFile->getClientOriginalName();
        $newImageFile->move(public_path('./uploads/meal'), $newImageName);

        $updateData['menu_image'] = $newImageName;

        Menu::where('id', $id)->update($updateData);
        return redirect()->route('partner#index')->with(['updateData' => 'Menu Has Been Updated Sucessfully!']);
    }
    private function requestUpdateMenuData($request)
    {
        $menuArray = [
            'menu_title' => $request->menu_title,
            'menu_description' => $request->menu_description,
            'menu_allergens' => $request->menu_allergens,
            'menu_nutritions' => $request->menu_nutritions,
            'ingredients' => $request->ingredients,
            'expiry_date' => $request->expiry_date,
            'safety_training' => $request->safety_training,
            'separate_storage' => $request->separate_storage,
            'partner_id' => $request->partner,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        if (isset($request->menu_image)) {
            $menuArray['menu_image'] = $request->menu_image;
        }

        return $menuArray;
    }

    //GET UPDATE PROFILE
    public function updateProfile($user_id){
        $partnerData = Partner::where('user_id', $user_id)->First();
        $userData = User::where('id', $user_id)->First();

        return view('Users.Partner.updatePartner2')->with(['partnerData' => $partnerData, 'userData' => $userData, ]);
    }
}