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
    Route::post("provider/deactivate", [ProviderController::class, "deactivate"]);
});

// RUTAS CHECK IN
Route::middleware('jwt')->group(function () {
    Route::post("/check_in/add",[CheckInController::class,"create"]);
    Route::get("/check_in",[CheckInController::class,"show"]);
    Route::get("/check_in/update", [CheckInController::class,"change"]);
    Route::get("/check_in/deactivate", [CheckInController::class, "deactivate"]);

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
    Route::post("/check_out/deactivate", [CheckOutController::class, "deactivate"]);
});

// RUTAS CATEGORY
Route::middleware('jwt')->group(function () {
    Route::post("/category/add",[CategoryController::class,"create"]);
    Route::get("/category", [CategoryController::class,"show"]);
    Route::post("/category/update", [CategoryController::class,"change"]);
    Route::post("/category/deactivate", [CategoryController::class, "deactivate"]);
});

// RUTAS SUBCATEGORY
Route::middleware('jwt')->group(function () {
    Route::post("/subCategory/add", [SubCategoryController::class,"create"]);
    Route::get("/subCategory", [SubCategoryController::class,"show"]);
    Route::post("/subCategory/update", [SubCategoryController::class,"change"]);
    Route::post("/subcategory/deactivate", [SubCategoryController::class, "deactivate"]);
});

// RUTAS PRODUCT
Route::middleware('jwt')->group(function () {
    Route::post("/product/add", [ProductController::class,"create"]);
    Route::get("/product", [ProductController::class,"show"]);
    Route::post("/product/update", [ProductController::class,"change"]);
    Route::post("/product/deactivate", [ProductController::class, "deactivate"]);
});

// RUTAS ADMIN
Route::middleware("admin")->group(function () {
    Route::get("/user", [UserController::class,"show"]);
    Route::get("/user/inactive", [UserController::class,"showInactive"]);
    Route::post("/user/activate", [UserController::class, "activate"]);
    Route::post("/user/deactivate", [UserController::class, "deactivate"]);
    Route::post("/provider/activate", [ProviderController::class, "activate"]);
    Route::post("/product/activate", [ProductController::class, "activate"]);
    Route::post("category/activate", [CategoryController::class, "activate"]);
    Route::post("/subcategory/activate", [SubCategoryController::class, "activate"]);
    Route::post("/check_in/activate", [CheckInController::class, "activate"]);
});

// RUTAS USER
Route::middleware('jwt')->group(function () {
    Route::get("/user/update", [UserController::class, "change"]);

});



Route::post("/login",[UserController::class,"login"]);
