<?php

namespace Elokaily\Auth\controllers\apis;

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
use Twilio\Rest\Client;

class AuthController extends Controller
{
    public function authenticate(Request $request){
        $credentials = $request->validate([
            'username' => 'required|min:1|max:200',
            'password' => 'required|min:1|max:200'
        ]);
//        dd($credentials , "test");
        if (Auth::attempt($credentials)){
            $user = Auth::user();
            $token = $user->createToken('user-token')->accessToken;
            $response = [
                'message'   => "User login",
                'token'     =>  $token
            ];
            return response()->json($response , 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function register(Request $request) {
        $data = $request->validate([
            "name"           => "required|string|max:255",
            "username"       => "required|string|max:255|unique:users|regex:/^\w*$/",
            "email"          => "required|email|max:255|unique:users",
            "phone_number"   => 'required|string|between:11,13|unique:users',
            "password"       => 'required|min:6|confirmed'
        ]);
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $response = [
            'message' => 'User Created successfully!',
            'user'    => $user
        ];
        return response()->json($response , 201);
    }

    public function send_sms(Request $request)
    {
        $receiver_number = "+201204495951";
        $message = 'SMSFrom Web Journey';
        try {
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiver_number,[
                'from' => $twilio_number,
                'body' => $message
            ]);
            return redirect()->back();
        }catch (Exception $e) {
            //
        }
    }
}
