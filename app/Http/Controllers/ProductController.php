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
        $product->stock = 0;
        $product->marca = $request->marca;
        $product->stock_min = $request->stock_min;
        $product->status = "ACTIVE";

        try {
            $product->save();
        } catch (\Exception $e) {
            return response()->json(["message", "Internal Server Error"], 500);
        }

        return response()->json(["message" => "Product Created Successfully"]);
    }
}
