<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$request->hasHeader("authorization")){
            return response()->json(["Message"=>"Bad Request"],400);
        }
        $authorization = $request->header("authorization");
        $SplitAuth = explode(" ",$authorization);
        if (count($SplitAuth) != 2){
            return response()->json(["Message"=>"Bad Request"],400);
        }elseif ($SplitAuth[0] != "Bearer"){
            return response()->json(["Message"=>"Bad Request"],400);
        }

        try {
//            $decodedToken = JWT::decode($SplitAuth[1],env("SECRET_KEY"),array('HS256'));
            JWT::decode($SplitAuth[1],env("SECRET_KEY"),array('HS256'));
        }catch (ExpiredException $exp){
            return response()->json(["Message"=>"Session Expired"],401);
        }catch (SignatureInvalidException $d){
            return response()->json(["Message"=>"Invalid Signature"],401);
        }catch (\Exception $e){
            return response()->json(["Message"=>"Internal Server Error"],500);
        }

//        $rut = $decodedToken->rut;
//
//        $usuarios = User::all()->where("rut",$rut);
//
//        if(count($usuarios) != 1){
//            return response()->json(["Message"=>"User does not exist"],401);
//        }
//
//        $usuario = $usuarios[0];
//
//        if ($usuario->role != "ADMIN"){
//            return response()->json(["Message"=>"Unauthorized"],403);
//        }

        return $next($request);
    }
}
