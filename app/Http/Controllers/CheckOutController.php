<?php

namespace App\Http\Controllers;

use App\Models\Check_out;
use App\Models\Check_out_detail;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckOutController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            "detail"=> "required|array"
        ]);

        if ($validator->fails()){
            return response()->json(["errors",$validator->errors()],400);
        }

        // DECODIFICA TOKEN SIN VALIDAR NI UNA WEA XQ YA SE VALIDO EN EL MIDDLEWARE
        $authorization = $request->header("authorization");
        $SplitAuth = explode(" ",$authorization);
        $token = JWT::decode($SplitAuth[1],env("SECRET_KEY"),array('HS256'));

        $CheckOut = new Check_out();
        $CheckOut->user_id = $token->id;
        $CheckOut->save();
        $CheckOutID = $CheckOut->id;

        foreach ($request->detail as $detail){
            $det = new Check_out_detail();
            $det->check_out_id = $CheckOutID;
            $det->product_id = $detail[0];
            $det->quantity = $detail[1];
            $det->save();
        }

        return response()->json(["message"=>"Check In Created Successfully"]);
    }
}
