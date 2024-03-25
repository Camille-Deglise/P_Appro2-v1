<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //event(new Registered($user));
    public function showRegistrationForm()
    {
        return view("login.register");
    }

    public function storeDB(RegisterRequest $request)
    {
        $user = User::create($request -> validated());

            event(new Registered($user));
            
            return redirect()->route("login")->with("success",
            "Votre inscription s'est bien effectuée. Vérifier votre lien par email pour pouvoir vous connecter");

    }
}
