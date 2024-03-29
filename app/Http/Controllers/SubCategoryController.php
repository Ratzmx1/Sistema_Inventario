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
        ]);

        if ($validator->fails()){
            return response()->json(["errors",$validator->errors()],400);
        }

        $subCategory = new SubCategory();
        $subCategory->name = $request->name;
        $subCategory->category_id = $request->category_id;
        try {
            $subCategory->save();
        }catch (\Exception $e){
            return response()->json(["message","Internal Server Error"],500);
        }

        return response()->json(["message"=>"SubCategory Created Successfully"]);
    }


    public function show(Request $request){
        $query = $request->query("query");

        $AllSubcategories = Subcategory::all();
        if(!$query){
            foreach ($AllSubcategories as $subcat){
                $subcat->categoria = $subcat->category()->first();
            }
            return response()->json(["data"=>$AllSubcategories]);
        }
        $subcategories = [];
        foreach ($AllSubcategories as $sub){
            if (strpos(" ".strtoupper($sub->name),strtoupper($query))  ) {
                array_push($subcategories,$sub);
            }
        }
        return response()->json(["data"=>$subcategories]);
    }

    public function change(Request $request){
        $validator = Validator::make($request->all(),[
            "id"=>"required|integer",
            "name"=>"required|string",
            "category_id"=>"required|integer"
        ]);

        if ($validator->fails()){
            return response()->json(["errors",$validator->errors()],400);
        }

        try {
            $changeSubCategory = SubCategory::find($request->id);
            $changeSubCategory->name = $request->name;
            $changeSubCategory->category_id = $request->category_id;
            $changeSubCategory->save();
        }catch (\Exception $e){
            return response()->json(["message","Internal Server Error"],500);
        }

        return response()->json(["message"=>"SubCategory Changed Successfully"]);
    }

    public function activate($id){
        $InactiveSubCategories = subCategory::onlyTrashed();
        foreach ($InactiveSubCategories as $i){
            if ($i->id == $id) {
                $i->restore();
            }
            else {
                return response()->json(["message" => "SubCategory Not Found"], 404);
            }
        }
        return response()->json(["message"=>"SubCategory Activated Successfully"]);
    }

    public function deactivate($id){
        try {
            $activeSubCategory = subCategory::find($id);
            $activeSubCategory->delete();
        } catch (\Exception $e) {
            return response()->json(["message" => "subCategory Not Found"], 404);
        }

        return response()->json(["message"=>"subCategory Deactivated Successfully"]);
    }
}
