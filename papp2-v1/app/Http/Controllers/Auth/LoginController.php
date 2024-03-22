<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view("login.login");
    }
    public function logout()
    {
        Auth::logout();
        return to_route('login')->with('success','Vous êtes déconnecté');
    }

    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->validated();
        if(Auth::attempt($credentials)) {
            return view('site.home');
        }
        return to_route('login')->withErrors([
            'email'=> 'Identifiants incorrects',
        ])->onlyInput('email');
        
    }
}
