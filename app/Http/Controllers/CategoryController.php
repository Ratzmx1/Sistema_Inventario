<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            "name"=>"required|string"
        ]);

        if ($validator->fails()){
            return response()->json(["errors",$validator->errors()],400);
        }

        $category = new Category();
        $category->name = $request->name;

        try {
            $category->save();
        }catch (\Exception $e){
            return response()->json(["message","Internal Server Error"],500);
        }

        return response()->json(["message"=>"Category Created Successfully"]);
    }

    public function show(Request $request){
        $query = $request->query("query");

        $AllCategories = Category::all();
        if(!$query){
            return response()->json(["data"=>$AllCategories]);
        }
        $categories = [];
        foreach ($AllCategories as $cat){
            if (strpos(" ".strtoupper($cat->name),strtoupper($query))  ) {
                    array_push($categories,$cat);
            }
        }
        return response()->json(["data"=>$categories]);
    }

}
