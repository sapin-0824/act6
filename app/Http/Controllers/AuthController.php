<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class AuthController extends Controller {
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return response()->json(['success' => true, 'redirect' => '/dashboard']);
        }
        return response()->json(['success' => false, 'message' => 'Invalid credentials']);
    }
    public function register(Request $request) {
        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json(['success' => true, 'message' => 'Registered successfully']);
    }
    public function redirectToProvider($provider) {
        return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback($provider) {
        $socialUser = Socialite::driver($provider)->user();
        $user = User::updateOrCreate([
            'email' => $socialUser->getEmail()
        ], [
            'first_name' => explode(' ', $socialUser->getName())[0],
            'last_name' => explode(' ', $socialUser->getName())[1] ?? '',
            'password' => Hash::make(uniqid()),
        ]);
        Auth::login($user);
        return redirect('/dashboard');
    }
}

