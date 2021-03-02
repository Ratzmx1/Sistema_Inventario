<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\CheckOutController;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\SubCategoryController;
use \App\Http\Controllers\CheckInDetailController;

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

// RUTAS PROVIDER
Route::middleware('jwt')->group(function () {
    Route::post("/provider/add",[ProviderController::class,"create"]);
    Route::get("/provider", [ProviderController::class,"show"]);
    Route::post("/provider/update", [ProviderController::class,"change"]);
});

// RUTAS CHECK IN
Route::middleware('jwt')->group(function () {
    Route::post("/check_in/add",[CheckInController::class,"create"]);
    Route::get("/check_in",[CheckInController::class,"show"]);
    Route::get("/check_in/update", [CheckInController::class,"change"]);

});

// RUTAS CHECK IN DETAIL
Route::middleware('jwt')->group(function () {
    Route::get("/check_in/detail/{id}",[CheckInDetailController::class,"show"]);
});

// RUTAS CHECK OUT
Route::middleware('jwt')->group(function () {
    Route::post("/check_out/add",[CheckOutController::class,"create"]);
    Route::get("/check_out",[CheckOutController::class,"show"]);
    Route::post("/check_out/update",[CheckOutController::class,"change"]);
});

// RUTAS CATEGORY
Route::middleware('jwt')->group(function () {
    Route::post("/category/add",[CategoryController::class,"create"]);
    Route::get("/category", [CategoryController::class,"show"]);
    Route::post("/category/update", [CategoryController::class,"change"]);
});

// RUTAS SUBCATEGORY
Route::middleware('jwt')->group(function () {
    Route::post("/subCategory/add", [SubCategoryController::class,"create"]);
    Route::get("/subCategory", [SubCategoryController::class,"show"]);
    Route::post("/subCategory/update", [SubCategoryController::class,"change"]);
});

// RUTAS PRODUCT
Route::middleware('jwt')->group(function () {
    Route::post("/product/add", [ProductController::class,"create"]);
    Route::get("/product", [ProductController::class,"show"]);
    Route::post("/product/update", [ProductController::class,"change"]);
});

// RUTAS ADMIN
Route::middleware("admin")->group(function () {
    Route::get("/user", [UserController::class,"show"]);
    Route::get("/user/inactive", [UserController::class,"showInactive"]);
    Route::get("/user/activate", [UserController::class, "activateUser"]);
});

// RUTAS USER
Route::middleware('jwt')->group(function () {
    Route::get("/user/deactivate", [UserController::class, "deactivateUser"]);

});



Route::post("/login",[UserController::class,"login"]);
