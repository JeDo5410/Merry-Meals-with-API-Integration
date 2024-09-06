<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Partner;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm(Request $request)
    {
        $interest = $request->query('interest') ?? session('google_auth_interest');
        $googleAuth = session('google_auth', false);
        
        return view('auth.register', [
            'interest' => $interest,
            'googleAuth' => $googleAuth,
            'googleName' => session('google_name'),
            'googleEmail' => session('google_email')
        ]);
    }

    protected function validator(array $data)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'gender' => ['required', 'string'],
            'age' => ['required', 'integer', 'min:0'], 
            'phone' => ['required', 'string', 'max:15'], 
            'address' => ['required', 'string', 'max:255'],
            'geolocation' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'in:member,partner,volunteer'], 
        ];

        if (!isset($data['google_id'])) {
            $rules['password'] = ['required', 'string', 'min:8'];
        }

        switch ($data['role']) {
            case 'member':
                $rules['service_eligibility'] = ['required', 'string'];
                $rules['dietary'] = ['nullable', 'string'];
                $rules['member_meal_duration'] = ['required', 'integer'];
                break;
            case 'partner':
                $rules['partnership_restaurant'] = ['required', 'string'];
                $rules['partnership_duration'] = ['required', 'string'];
                break;
            case 'volunteer':
                $rules['volunteer_vaccination'] = ['required', 'boolean'];
                $rules['volunteer_duration'] = ['required', 'string'];
                $rules['volunteer_available'] = ['required', 'array'];
                break;
        }

        return Validator::make($data, $rules);
    }

    protected function create(array $data)
    {
        DB::beginTransaction();

        try {
            $userData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'gender' => $data['gender'],
                'age' => $data['age'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'geolocation' => $data['geolocation'],
                'role' => $data['role'],
            ];

            if (isset($data['google_id'])) {
                $userData['google_id'] = $data['google_id'];
                $userData['password'] = Hash::make(str_random(16));
            } else {
                $userData['password'] = Hash::make($data['password']);
            }

            $user = User::create($userData);

            switch ($data['role']) {
                case 'member':
                    Member::create([
                        'user_id' => $user->id,
                        'service_eligibility' => $data['service_eligibility'],
                        'dietary' => $data['dietary'] ?? null,
                        'member_meal_duration' => $data['member_meal_duration'],
                    ]);
                    break;
                case 'partner':
                    Partner::create([
                        'user_id' => $user->id,
                        'partnership_restaurant' => $data['partnership_restaurant'],
                        'partnership_address' => $data['address'],
                        'partnership_duration' => $data['partnership_duration'],
                    ]);
                    break;
                case 'volunteer':
                    Volunteer::create([
                        'user_id' => $user->id,
                        'volunteer_vaccination' => $data['volunteer_vaccination'],
                        'volunteer_duration' => $data['volunteer_duration'],
                        'volunteer_available' => json_encode($data['volunteer_available']),
                    ]);
                    break;
            }

            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}