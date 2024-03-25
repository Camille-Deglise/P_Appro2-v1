<?php

namespace App\Http\Controllers\Auth;

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
        return to_route('login')->with('success','Vous êtes bien déconnecté');
    }

    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->validated();
        // Authentification de l'utilisateur
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            
            // Vérification si l'e-mail de l'utilisateur est vérifié
            if ($user->email_verified_at != null) {
                $request->session()->regenerate();
                return view('site.home');
            } else {
                // Déconnexion de l'utilisateur car l'e-mail n'est pas vérifié
                Auth::logout();
                // Redirection vers la page de connexion avec un message d'erreur
                return redirect()->route('login')->withErrors([
                    'email'=> "Votre e-mail n'a pas été vérifié.",
                ])->withInput($request->only('email'))->with('message','Veuillez vérifier votre e-mail pour pouvoir vous connecter.');
            }
        }

        // Redirection en cas d'échec de l'authentification
        return redirect()->route('login')->withErrors([
            'email'=> "Identifiants incorrects",
        ])->withInput($request->only('email'))->with('message','Veuillez entrer des identifiants valides');
    }
}
