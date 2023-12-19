<?php

namespace Elokaily\Auth\controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        $data["title"] = "Login";
        return view("auth::pages.login" , $data);
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            "username" => "required|string|max:50",
            "password" => "required|string|max:255"
        ]);
        if (Auth::attempt($credentials)){
            return to_route("home");
        }
        else {
            return redirect()->back()->withErrors(["error" => "username or password is wrong"]);
        }
    }

    public function register() {
        $data["title"] = "Register";
        return view("auth::pages.register" , $data);
    }

    public function store(Request $request) {
        $data = $request->validate([
            "name"           => "required|string|max:255",
            "username"       => "required|string|max:255|unique:users|regex:/^\w*$/",
            "email"          => "required|email|max:255|unique:users",
            "phone_number"   => 'required|string|between:11,13',
            "password"       => 'required|min:6|confirmed'
        ]);
        $user = User::create($data);
        return to_route("auth.login")->with("success" , "User added successfully");
    }
}
