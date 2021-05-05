<?php

namespace App\Http\Controllers;

use App\Models\Check_in_detail;
use App\Models\Product;

class CheckInDetailController extends Controller
{
    public function show($id){

        $details = Check_in_detail::all()->where("check_in_id","==",intval($id));
        if (count($details) == 0){
            return response()->json(["message"=>"No Data Found"],404);
        }
        foreach ($details as $d){
            $id_prod = $d->product_id;
            $d->productName = Product::withTrashed()->find($id_prod)->first()->name;
        }
        return response()->json(["data"=>$details]);
    }
}

