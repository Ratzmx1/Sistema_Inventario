<?php

namespace App\Http\Controllers;

use App\Models\Check_in_detail;
use Illuminate\Http\Request;

class CheckInDetailController extends Controller
{
    public function show(Request $request){
        $query = $request->query("query");

        $details = Check_in_detail::all()->where("check_in_id","==",$query);
        if (count($details) == 0){
            return response()->json(["message"=>"No Data Found"],404);
        }
        foreach ($details as $d){
            $d->productName = $d->product()->first()->name;
        }
        return response()->json(["data"=>$details]);
    }
}

