<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Partner;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;  // Import Socialite for Google API
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class GoogleController extends Controller
{
    public function googlepage(Request $request) {
        if ($request->isMethod('post')) {
            $formData = $request->except('_token');
            session(['google_auth_form_data' => $formData]);
            \Log::info('Received form data:', $formData);
        }

        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            // Use Guzzle client to bypass SSL verification
            $client = new Client([
                'verify' => false,
            ]);

            //Fetch google user using socialite
            $user = Socialite::driver('google')->user();
       
            
            // First, try to find the user by Google ID
            $finduser = User::where('google_id', $user->id)->first();
            
            // If not found by Google ID, try to find by email
            if (!$finduser) {
                $finduser = User::where('email', $user->email)->first();
            }

            if($finduser)
            {
                Auth::login($finduser);
                return redirect()->intended('dashboard');
            }
                
            // If user does not exist in the database, create a new user
            else
            {
                // Retrieve the stored form data
                $formData = session('google_auth_form_data', []);

                if (!empty($formData)) {
                 // Store Google user info in session
                 $userData = array_merge($formData, [
                    'google_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    // Add any other Google-specific data you need
                ]);
                
                // Create the user
                $newUser = $this->createUser($userData);

                Auth::login($newUser);

                // Clear the session data
                session()->forget('google_auth_form_data');

                return redirect()->intended('dashboard');
            } else  {
                return redirect()->route('choose.interest');
            }
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    protected function createUser(array $data)
    {
        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make(Str::random(16)), // generate a random password
                'google_id' => $data['google_id'],
                'gender' => $data['gender'],
                'age' => $data['age'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'geolocation' => $data['geolocation'],
                'role' => $data['role'],
            ]);

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

    public function loginWithGoogle()
    {
        return Socialite::driver('google')->redirect();

    }

}