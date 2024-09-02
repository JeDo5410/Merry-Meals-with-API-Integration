<?php

namespace App\Actions\Fortify;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Partner;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;


class CreateNewUser implements CreatesNewUsers
{
    
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            //     'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //     'password' => $this->passwordRules(),
            //     'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // return User::create([
        //     'name' => $input['name'],
        //     'email' => $input['email'],
        //     'password' => Hash::make($input['password']),
        // ]);

        $user = new User();
        $user->name = $input['name'];
        $user->gender = $input['gender'];
        $user->age = $input['age'];
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);
        $user->phone = $input['phone'];
        $user->address = $input['address'];
        $user->geolocation = $input['geolocation'];
        $user->role = $input['role'];
        $user->save();

        if ($input['role'] == 'member') {
            Validator::make($input, [
                'service_eligibility' => ['required', 'string', 'max:255'],
                'dietary' => ['required', 'string', 'max:255'],
            ])->validate();
            $member = new Member();
            $member->member_meal_duration = $input['member_meal_duration'];
            $member->service_eligibility = $input['service_eligibility'];
            $member->dietary = $input['dietary'];
            $member->user_id = $user->id;
            // $user->save();
            $member->save();
        }

        if ($input['role'] == 'partner') {
            Validator::make($input, [
                'partnership_restaurant' => ['required', 'string', 'max:255'],
                'partnership_duration' => ['required', 'string', 'max:255'],
            ])->validate();
            $partner = new Partner();
            $partner->partnership_restaurant = $input['partnership_restaurant'];
            $partner->partnership_duration = $input['partnership_duration'];
            $partner->partnership_address =  $input['address'];
            $partner->user_id = $user->id;
            // $user->save();
            $partner->save();
        }

        if ($input['role'] == 'volunteer') {
            Validator::make($input, [
                'volunteer_vaccination' => ['required', 'string', 'max:255'],
                'volunteer_duration' => ['required', 'string', 'max:255'],
                // 'volunteer_available' => ['required', 'string', 'max:255'],
            ])->validate();
            $volunteer = new Volunteer();
            $volunteer->volunteer_vaccination = $input['volunteer_vaccination'];
            $volunteer->volunteer_duration = $input['volunteer_duration'];
            $volunteer->volunteer_available = implode(",", $input['volunteer_available']);
            $volunteer->user_id = $user->id;
            // $user->save();
            $volunteer->save();
        }


        return $user;
    }
}