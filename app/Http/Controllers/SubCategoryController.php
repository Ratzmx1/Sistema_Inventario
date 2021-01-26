<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            "name"=>"required|string",
            "category_id" =>"required|integer",
            "status"=>"required|string"
        ]);

        if ($validator->fails()){
            return response()->json(["errors",$validator->errors()],400);
        }

        $subCategory = new SubCategory();
        $subCategory->name = $request->name;
        $subCategory->category_id = $request->category_id;
        $subCategory->status = $request->status;
        try {
            $subCategory->save();
        }catch (\Exception $e){
            return response()->json(["message","Internal Server Error"],500);
        }

        return response()->json(["message"=>"SubCategory Created Successfully"]);
    }
}
