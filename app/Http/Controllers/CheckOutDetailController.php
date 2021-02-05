<?php

namespace App\Http\Controllers;

use App\Models\Check_out_detail;
use Illuminate\Http\Request;

class CheckOutDetailController extends Controller
{
    public function show(Request $request){
        $query = $request->query("query");

        $details = Check_out_detail::all()->where("check_out_id","==",$query);
        if (count($details) == 0){
            return response()->json(["message"=>"No Data Found"],404);
        }
        foreach ($details as $d){
            $d->productName = $d->product()->first()->name;
        }
        return response()->json(["data"=>$details]);
    }
}
