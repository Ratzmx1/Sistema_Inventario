<?php

namespace App\Http\Controllers;

use App\Models\Check_out_detail;
use App\Models\Product;

class CheckOutDetailController extends Controller
{
    public function show($id){

        $details = Check_out_detail::all()->where("check_out_id","==",intval($id));
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
