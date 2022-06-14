<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendMailRemember;
use App\Notifications\ResetPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;

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

    public function forgotPassword(){
        return view('auth.forgot-password');
    }


    public function sendToken(Request $request){

        $user = User::where([
            'email' => trim($request->email)
        ])->first();

        if($user){
            Notification::send($user, new ResetPassword($user));
            return redirect()->route('login')->with('status', 'Um e-mail foi enviado para sua caixa de entrada, siga as instruções para realizar a recuperação da senha.');
        }else{
            return redirect()->route('auth.forgot-password')->with('warning', 'Não encontramos o e-mail informado em nosso cadastro, verifique e tente novamente.');
        }

        //Mail::to($request->email)->send(new sendMailRemember($user->remember_token));

    }

    public function resetPassword($token){
        $user = User::where([
            'remember_token' => $token
        ])->first();

        if($user)
            return view('auth.reset-password', compact('user'));
        else
            return redirect()->route('login')->with('warning', 'Token invalido ou expirado, verifique e tente novamente, caso o erro persista, entre em contato conosco.');
    }

    public function updatePassword($user, Request $request)
    {

        $user = User::where(['remember_token'=>$user])->first();

        if($user){
            $user->forceFill([
                'password' => Hash::make($request->password),
            ])->save();

            return redirect()->route('login')->with('status', 'A senha foi alterada com sucesso, realize o login novamente com as novas credenciais.');
        }else{
            return redirect()->route('login')->with('warning', 'Token invalido ou expirado, verifique e tente novamente, caso o erro persista, entre em contato conosco.');
        }
    }

}
