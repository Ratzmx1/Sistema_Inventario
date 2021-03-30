<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


/**
 * @OA\Info(title="User endpoints", version="1.0")
 *
 * @OA\Server(url="localhost:8000")
 *
 *
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

    public function show(Request $request){
        $query = $request->query("query");

        $AllUsers = User::all();
        if(!$query){
            return response()->json(["data"=>$AllUsers]);
        }
        $users = [];
        foreach ($AllUsers as $u){
            if (strpos(" ".strtoupper($u->name),strtoupper($query))  ) {
                    array_push($users,$u);
            }
        }
        return response()->json(["data"=>$users]);
    }

    public function showInactive(Request $request){
        $query = $request->query("query");

        $DeletedUsers = User::onlyTrashed();

        if(!$query){
            return response()->json(["data"=>$DeletedUsers]);
        }
        $users = [];
        foreach ($DeletedUsers as $u){
            if (strpos(" ".strtoupper($u->name),strtoupper($query))  ) {
                    array_push($users,$u);
            }
        }
        return response()->json(["data"=>$users]);
    }

    public function activate(Request $id){
        $InactiveUsers = User::onlyTrashed();
        foreach ($InactiveUsers as $i){
            if ($i->id == $id) {
                $i->restore();
                return response()->json(["message"=>"User Activated Successfully"]);
            }
        }
        return response()->json(["message" => "User Not Found"], 404);
    }

    public function deactivate(Request $id){
        try {
            $activeUser = User::findOrFail($id);
            $activeUser->delete();
            return response()->json(["message"=>"User Deactivated Successfully"]);
        } catch (\Exception $e) {
            return response()->json(["message" => "User Not Found"], 404);
        }
    }

    public function change(Request $request){
        $validator = Validator::make($request->all(),[
            "id"=>"required|integer",
            "password"=>"required|string",
            "email"=>"required|string",
            "name"=>"required|string",
            "lastname"=>"required|string",
            "role_id"=>"required|integer"
        ]);

        if ($validator->fails()){
            return response()->json(["errors",$validator->errors()],400);
        }

        try {
            $changeUser = User::find($request->id);
            $changeUser->password = bcrypt($request->password);
            $changeUser->email = $request->email;
            $changeUser->name = $request->name;
            $changeUser->lastname = $request->lastname;
            $changeUser->role_id = $request->role;
            $changeUser->save();
        }catch (\Exception $e){
            return response()->json(["message","Internal Server Error"],500);
        }

        return response()->json(["message"=>"User Changed Successfully"]);
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            "email"=>"required|string",
            "password"=>"required|string",
            "name"=>"required|string",
            "lastname"=>"required|string",
            "role_id"=>"required|integer"
        ]);

        if ($validator->fails()){
            return response()->json(["errors",$validator->errors()],400);
        }

        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->role_id = $request->role;

        try {
            $user->save();
        } catch (\Exception $e) {
            return response()->json(["message", "Internal Server Error"], 500);
        }
        return response()->json(["message" => "User Created Successfully"]);
    }
}
