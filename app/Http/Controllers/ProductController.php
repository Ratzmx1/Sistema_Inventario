<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "subcategory_id" => "required|integer",
            "marca" => "required|string",
            "stock_min" => "required|integer"
        ]);

        if ($validator->fails()) {
            return response()->json(["errors", $validator->errors()], 400);
        }

        $product = new Product();
        $product->name = $request->name;
        $product->subcategory_id = $request->subCategory_id;
        $product->marca = $request->marca;
        $product->stock_min = $request->stock_min;

        try {
            $product->save();
        } catch (\Exception $e) {
            return response()->json(["message"=>"Internal Server Error"], 500);
        }
        return response()->json(["message" => "Product Created Successfully"]);
    }

    public function show(Request $request){
        $query = $request->query("query");

        $AllProducts = Product::all();
        if(!$query){
            return response()->json(["data"=>$AllProducts]);
        }
        $products = [];
        foreach ($AllProducts as $prod){
            if (strpos(" ".strtoupper($prod->name),strtoupper($query))  ) {
                array_push($products,$prod);
            }
        }
        return response()->json(["data"=>$products]);
    }

    public function change(Request $request){
        $validator = Validator::make($request->all(),[
            "id"=>"required|integer",
            "name"=>"required|string",
            "subCategory_id"=>"required|integer",
            "stock"=>"required|integer",
            "marca"=>"required|string",
            "stock_min"=>"required|integer",
            "status"=>"required|string"
        ]);

        if ($validator->fails()){
            return response()->json(["errors",$validator->errors()],400);
        }

        $changeProduct = Product::find($request->id);
        $changeProduct->name = $request->name;
        $changeProduct->subCategory_id = $request->subCategory_id;
        $changeProduct->stock = $request->stock;
        $changeProduct->marca = $request->marca;
        $changeProduct->stock_min = $request->stock_min;
        $changeProduct->status = $request->status;

        try {
            $changeProduct->save();
        }catch (\Exception $e){
            return response()->json(["message","Internal Server Error"],500);
        }

        return response()->json(["message"=>"Product Changed Successfully"]);
    }

    public function activate($id){
        $InactiveProducts = Product::onlyTrashed();
        foreach ($InactiveProducts as $i){
            if ($i->id == $id) {
                $i->restore();
            }
            else {
                return response()->json(["message" => "Product Not Found"], 404);
            }
        }
        return response()->json(["message"=>"Product Activated Successfully"]);
    }

    public function deactivate($id){
        try {
            $activeProduct = Product::find($id);
            $activeProduct->delete();
        } catch (\Exception $e) {
            return response()->json(["message" => "Product Not Found"], 404);
        }

        return response()->json(["message"=>"Product Deactivated Successfully"]);
    }
}
