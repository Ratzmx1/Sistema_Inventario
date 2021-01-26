<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProviderController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            "name"=>"required|string",
            "address"=>"required|string",
            "phone"=>"required|integer"
        ]);

        if ($validator->fails()){
            return response()->json(["errors",$validator->errors()],400);
        }

        $provider = new Provider();
        $provider->name = $request->name;
        $provider->address = $request->address;
        $provider->telephone = $request->phone;
        try {
            $provider->save();
        }catch (\Exception $e){
            return response()->json(["message","Internal Server Error"],500);
        }

        return response()->json(["message"=>"Provider Created Successfully"]);
    }
}
