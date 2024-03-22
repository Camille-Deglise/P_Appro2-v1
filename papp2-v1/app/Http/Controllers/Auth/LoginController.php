<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view("login.login");
    }

    public function connected(LoginRequest $request)
    {
        $credentials = $request->validated();

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended(route('site.home'));
        }
        return to_route('login.login')->withErrors([
            'email' => 'Email invalide',
            //'password' => 'Mot de passe invalide' , 'password' dans le OnlyInput à vérifier

        ])->onlyInput('email');

    }
}
