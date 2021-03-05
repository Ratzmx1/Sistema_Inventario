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

    public function change(Request $request){
        $validator = Validator::make($request->all(),[
            "id"=>"required|integer",
            "name"=>"required|string"
        ]);

        if ($validator->fails()){
            return response()->json(["errors",$validator->errors()],400);
        }

        $changeCategory = Category::find($request->id);
        $changeCategory->name = $request->name;

        try {
            $changeCategory->save();
        }catch (\Exception $e){
            return response()->json(["message","Internal Server Error"],500);
        }

        return response()->json(["message"=>"Category Changed Successfully"]);
    }

    public function activate($id){
        $InactiveCategories = Category::onlyTrashed();
        foreach ($InactiveCategories as $i){
            if ($i->id == $id) {
                $i->restore();
            }
            else {
                return response()->json(["message" => "Category Not Found"], 404);
            }
        }
        return response()->json(["message"=>"Category Activated Successfully"]);
    }

    public function deactivate($id){
        try {
            $activeCategory = Category::find($id);
            $activeCategory->delete();
        } catch (\Exception $e) {
            return response()->json(["message" => "Category Not Found"], 404);
        }

        return response()->json(["message"=>"Category Deactivated Successfully"]);
    }
}

//TODO softDelete cascade??
