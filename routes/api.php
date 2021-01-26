<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('jwt')->group(function () {
    // Agrega las rutas con autenticacion normal
    Route::post("/provider/create",[\App\Http\Controllers\ProviderController::class,"create"]);
    Route::post("/category/create",[\App\Http\Controllers\CategoryController::class,"create"]);
    Route::post("/subCategory/create",[\App\Http\Controllers\SubCategoryController::class,"create"]);
    Route::post("/product/create",[\App\Http\Controllers\ProductController::class,"create"]);
});

Route::middleware("admin")->group(function () {
    // Agrega las rutas del admin
});


Route::post("/login",[UserController::class,"login"]);
