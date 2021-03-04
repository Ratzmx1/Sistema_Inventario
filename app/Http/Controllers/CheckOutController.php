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

    public function show(Request $request){
        $query = $request->query("query");

        $AllCheck_outs = Check_out::all();
        $check_out = [];
        if(!$query){
            foreach ($AllCheck_outs as $out){
                $out->userName = $out->user()->first()->name;
                array_push($check_out,$out);
            }
            return response()->json(["data"=>$check_out]);
        }
        foreach ($AllCheck_outs as $out){
            if (strpos(" ".($out->order_number),($query))) {
                $out->userName = $out->user()->first()->name;
                array_push($check_out,$out);
            }
        }
        return response()->json(["data"=>$check_out]);
    }

    public function change(Request $request){
        $validator = Validator::make($request->all(),[
            "id"=>"required|integer",
            "user_id"=>"required|integer",
            "detail"=> "required|array"
        ]);

        if ($validator->fails()){
            return response()->json(["errors",$validator->errors()],400);
        }

        $changeCheckOut = Check_out::find($request->id);
        $changeCheckOut->user_id = $request->user_id;
        $changeCheckOut->save();

        foreach ($request->detail as $detail){
            $det = Check_out_detail::find($request->detail_id);
            $det->product_id = $detail[0];
            $det->quantity = $detail[1];
            $det->save();
        }

        return response()->json(["message"=>"Check_out Changed Successfully"]);
    }

    public function activate($id, $detail_id){
        $InactiveCheck_outs = Check_out::onlyTrashed();
        $InactiveCheck_out_details = Check_out_detail::onlyTrashed();
        foreach ($InactiveCheck_outs as $i){
            if ($i->id == $id) {
                $i->restore();
            }
            else {
                return response()->json(["message" => "Check_out Not Found"], 404);
            }
        }
        foreach ($InactiveCheck_out_details as $i){
            if ($i->id == $detail_id) {
                $i->restore();
            }
        }
        return response()->json(["message"=>"Check_out Activated Successfully"]);
    }

    public function deactivate($id, $detail_id){
        try {
            $activeCheck_out = Check_out::find($id);
            $activeCheck_out_details = Check_out_detail::find($detail_id);
            $activeCheck_out->delete();
            $activeCheck_out_details->delete();
        } catch (\Exception $e) {
            return response()->json(["message" => "Check_out Not Found"], 404);
        }

        return response()->json(["message"=>"Check_out Deactivated Successfully"]);
    }
}
