<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;  // Import Socialite for Google API

class GoogleController extends Controller
{
    public function handleGoogleCallback(Request $request)
    {
        // Get Google user details
        $user = Socialite::driver('google')->stateless()->user();

        // Combine Google data with registration form data
        $userData = [
            'email' => $user->getEmail(),
            'name' => $user->getName(),
            // Other data from the registration form
            'gender' => $request->input('gender'),
            'age' => $request->input('age'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ];

        // Create or retrieve the user based on their email
        $existingUser = User::firstOrCreate(['email' => $user->getEmail()], [
            'name' => $user->getName(),
            'gender' => $request->input('gender'),
            'age' => $request->input('age'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);

        // Log in the user
        Auth::login($existingUser, true);

        // Redirect to the desired page after login
        return redirect()->route('dashboard');  // Change the route as needed
    }
}