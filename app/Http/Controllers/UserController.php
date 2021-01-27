<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /*
     *
     *
     */
    public function login(Request $request){
        $credentials = $request->only(["email","password"]);
        $isValid = Auth::attempt($credentials);
        if (!$isValid){
            return response()->json(["message"=>"Wrong Credentials"],400);
        }

        $id = Auth::user()->id;

        $now_seconds = time();
        $token = JWT::encode([
            "iat" => $now_seconds,
            "exp" => $now_seconds+(60*10),
            'id'=>$id
        ],env("SECRET_KEY"));

        return response()->json(["message"=>"Logged in","token"=>$token]);
    }
}
