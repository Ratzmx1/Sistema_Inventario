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
            "subCategory_id" => "required|integer",
            "stock" => "required|integer",
            "marca" => "required|string",
            "minimStock" => "required|integer",
            "status" => "required|string"
        ]);

        if ($validator->fails()) {
            return response()->json(["errors", $validator->errors()], 400);
        }

        $product = new Product();
        $product->name = $request->name;
        $product->subCategory_id = $request->subCategory_id;
        $product->stock = $request->stock;
        $product->marca = $request->marca;
        $product->minimStock = $request->minimStock;
        $product->status = $request->status;
        try {
            $product->save();
        } catch (\Exception $e) {
            return response()->json(["message", "Internal Server Error"], 500);
        }

        return response()->json(["message" => "Product Created Successfully"]);
    }
}
