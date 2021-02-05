<?php

namespace App\Http\Controllers;

use App\Models\Check_in;
use App\Models\Check_in_detail;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckInController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            "provider_id"=>"required|integer",
            "n_guia"=>"required|integer",
            "detail"=> "required|array"
        ]);

        if ($validator->fails()){
            return response()->json(["errors",$validator->errors()],400);
        }

        // DECODIFICA TOKEN SIN VALIDAR NI UNA WEA XQ YA SE VALIDO EN EL MIDDLEWARE
        $authorization = $request->header("authorization");
        $SplitAuth = explode(" ",$authorization);
        $token = JWT::decode($SplitAuth[1],env("SECRET_KEY"),array('HS256'));

        $CheckIn = new Check_in();
        $CheckIn->provider_id = $request->provider_id;
        $CheckIn->order_number = $request->n_guia;
        $CheckIn->user_id = $token->id;
        $CheckIn->save();
        $CheckInID = $CheckIn->id;

        foreach ($request->detail as $detail){
            $det = new Check_in_detail();
            $det->check_in_id = $CheckInID;
            $det->product_id = $detail[0];
            $det->quantity = $detail[1];
            $det->save();
        }

        return response()->json(["message"=>"Check In Created Successfully"]);
    }

    public function show(Request $request){
        $query = $request->query("query");

        $AllCheck_ins = Check_in::all();
        if(!$query){
            foreach ($AllCheck_ins as $in){
                $in->nombreProveedor = $in->provider()->first();
            }
            return response()->json(["data"=>$AllCheck_ins]);
        }
        $check_in = [];
        foreach ($AllCheck_ins as $in){
            if (strpos(" ".($in->order_number),($query))) {
                $in->nombreProveedor = $in->provider()->first();
                array_push($check_in,$in);}
        }
        return response()->json(["data"=>$check_in]);
    }
}
