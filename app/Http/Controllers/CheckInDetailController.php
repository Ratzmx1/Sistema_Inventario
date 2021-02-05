<?php

namespace App\Http\Controllers;

use App\Models\Check_in_detail;
use Illuminate\Http\Request;

class CheckInDetailController extends Controller
{
    public function show($id){
        $details = Check_in_detail::all()->where("check_in_id","==",$id);
        if (count($details) == 0){
            return response()->json(["message"=>"No Data Found"],404);
        }
//        foreach ($details as $detail){
//            $detail->products = $detail->product;
//        }
        return response()->json(["data"=>$details]);
    }
}
