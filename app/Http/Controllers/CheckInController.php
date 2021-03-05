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
        $check_in = [];
        if(!$query){
            foreach ($AllCheck_ins as $in){
                $in->providerName = $in->provider()->first()->name;
                $in->userName = $in->user()->first()->name;
                array_push($check_in,$in);
            }
            return response()->json(["data"=>$check_in]);
        }
        foreach ($AllCheck_ins as $in){
            if (strpos(" ".($in->order_number),($query))) {
                $in->nombreProveedor = $in->provider()->first()->name;
                $in->userName = $in->user()->first()->name;
                array_push($check_in,$in);
            }
        }
        return response()->json(["data"=>$check_in]);

    }

    public function change(Request $request){
        $validator = Validator::make($request->all(),[
            "id"=>"required|integer",
            "detail_id"=>"required|integer",
            "provider_id"=>"required|integer",
            "order_number"=>"required|integer",
            "user_id"=>"required|integer",
            "detail"=> "required|array"
        ]);

        if ($validator->fails()){
            return response()->json(["errors",$validator->errors()],400);
        }

        $changeCheckIn = Check_in::find($request->id);
        $changeCheckIn->provider_id = $request->provider_id;
        $changeCheckIn->order_number = $request->order_number;
        $changeCheckIn->user_id = $request->user_id;
        $changeCheckIn->save();

        foreach ($request->detail as $detail){
            $det = Check_in_detail::find($request->detail_id);
            $det->product_id = $detail[0];
            $det->quantity = $detail[1];
            $det->save();
        }

        return response()->json(["message"=>"Check_in Changed Successfully"]);
    }

    public function activate($id){
        try {
            $inactiveCheck_ins = Check_in::onlyTrashed()->findOrFail($id);
            $inactiveCheck_ins->restore();
            $inactiveCheck_in_details = $inactiveCheck_ins->details;
            foreach ($inactiveCheck_in_details as $i){
                $i->restore();
            }
        } catch (\Exception $e) {
            return response()->json(["message" => "Check_in Not Found"], 404);
        }
        return response()->json(["message"=>"Check_in Activated Successfully"]);
    }

    public function deactivate($id){
        try {
            $activeCheck_in = Check_in::findOrFail($id);
            $activeCheck_in_details = $activeCheck_in->details;
            $activeCheck_in->delete();
            foreach ($activeCheck_in_details as $i){
                $i->delete();
            }
        } catch (\Exception $e) {
            return response()->json(["message" => "Check_in Not Found"], 404);
        }

        return response()->json(["message"=>"Check_in Deactivated Successfully"]);
    }
}
