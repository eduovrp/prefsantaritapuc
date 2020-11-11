<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function handleProviderCallback($provider)
    {

            $providerUser = Socialite::driver($provider)->user();

            $user = User::firstOrCreate(['email'=>$providerUser->getEmail()],[
                'name' => $providerUser->getName() ?? $providerUser->getNickname(),
                'provider_id' => $providerUser->getId(),
                'provider' => $provider,
                'avatar_url' => $providerUser->getAvatar(),
            ]);

            Auth::login($user);

            return redirect('/');


    }
}
