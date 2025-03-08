<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        $user = User::firstOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'first_name' => explode(' ', $socialUser->getName())[0],
                'last_name' => explode(' ', $socialUser->getName())[1] ?? '',
                'auth_provider' => $provider,
            ]
        );

        Auth::login($user);

        return redirect('/dashboard');
    }
}
