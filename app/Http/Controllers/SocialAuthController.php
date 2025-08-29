<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Socialite;
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
        $socialUser = Socialite::driver($provider)->stateless()->user();

        $user = User::firstOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'name' => $socialUser->getName(),
                'password' => bcrypt(Str::random(16)), // Random password
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
            ]
        );

        Auth::login($user);

        return redirect()->route('dashboards.index');
    }
}
