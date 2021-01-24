<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use Illuminate\Http\Request;

class JWTMiddlewareAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if(!$request->hasHeader("authorization")){  // Valida si se recibio el token
            return response()->json(["Message"=>"Bad Request"],400);
        }
        $authorization = $request->header("authorization");
        $SplitAuth = explode(" ",$authorization);
        if (count($SplitAuth) != 2){    // Valida formato Token
            return response()->json(["Message"=>"Bad Request"],400);
        }elseif ($SplitAuth[0] != "Bearer"){
            return response()->json(["Message"=>"Bad Request"],400);
        }
        try {
            JWT::decode($SplitAuth[1],env("SECRET_KEY"),array('HS256'));    // Intenta decodificar el token
        }catch (ExpiredException $exp){     // Excepciones en caso de error
            return response()->json(["Message"=>"Session Expired"],401);
        }catch (SignatureInvalidException $d){
            return response()->json(["Message"=>"Invalid Signature"],401);
        }catch (\Exception $e){
            return response()->json(["Message"=>"Internal Server Error"],500);
        }


        return $next($request); // Todito fue validado de pana
    }
}
