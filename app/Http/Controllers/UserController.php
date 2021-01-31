<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Info(title="User endpoints", version="1.0")
 *
 * @OA\Server(url="localhost:8000")
 */
class UserController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Inicia Sesion",
     *     @OA\Response(
     *         response=200,
     *         description="Genera Token"
     *     ),
     *     @OA\Parameter(
     *      name="email",
     *      description="Email",
     *      in="query",
     *      required=true,
     *   ),
     *    @OA\Parameter(
     *      name="password",
     *      description="Contraseña de minimo 6 caracteres",
     *      in="query",
     *      required=true,
     *   ),
     *     @OA\Response(
     *         response=401,
     *         description="Usuario no autorizado"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Server error"
     *     )
     * )
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
            "exp" => $now_seconds+(60*60*30),
            'id'=>$id
        ],env("SECRET_KEY"));

        return response()->json(["message"=>"Logged in","token"=>$token]);
    }
}
