<?php

namespace App\Http\Controllers;

use App\Models\Check_in_detail;
use Illuminate\Http\Request;

class CheckInDetailController extends Controller
{
    public function show($id){

        $details = Check_in_detail::all()->where("check_in_id","==",intval($id));
        if (count($details) == 0){
            return response()->json(["message"=>"No Data Found"],404);
        }
        $array = [];
        foreach ($details as $d){
            $d->productName = $d->product()->first()->name;
            array_push($array,$d);
        }
        return response()->json(["data"=>$array]);
    }
}

