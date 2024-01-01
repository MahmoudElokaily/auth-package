<?php

namespace Elokaily\Auth\controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Elokaily\Auth\Mail\ResetPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
        return to_route("login")->with("success" , "User added successfully");
    }

    public function forgetPassword(){
        $data["title"] = __("Forget password");
        return view("auth::pages.forget-password" , $data);
    }

    public function sendMail(Request $request){
        $this->validate($request, ['email' => 'required|email|exists:users']);
        $token = Str::random(64);
        $email = $request->input("email");
        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        Mail::to($email)->send(new ResetPasswordMail($token));
        session()->flash("success" , "We have e-mailed your password reset link!");
        return to_route("login");
    }

    public function resetPassword($token) {
        $data["title"] = __("Reset Password");
        return view("auth::pages.reset-password" , compact('token'));
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        $updatePassword = DB::table('password_reset_tokens')
            ->where('token' , $request->token)
            ->first();
        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }
        $user = User::where('email', $updatePassword->email)
            ->update(['password' => Hash::make($request->password)]);
        DB::table('password_reset_tokens')->where(['email'=> $updatePassword->email])->delete();
        session()->flash("success" , "Your password has been changed!");
        return to_route("login");
    }
    public function logout() {
        Auth::logout();
        session()->flash("success" ,  "Logout successfully");
        return to_route("login");
    }
}
