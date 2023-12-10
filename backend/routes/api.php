<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function(){
  Route::post("/register",[AuthController::class , "register"]);
  Route::post("/login",[AuthController::class , "login"]);
});
  
Route::middleware('auth:sanctum')->group(function(){
  Route::post("/product/cashier",[ProductController::class , "cashier"]);
  Route::post("/product",[ProductController::class , "create"]);
  Route::get("/product",[ProductController::class , "getAll"]); 
  Route::delete("/product/{id}",[ProductController::class , "delete"]);
  Route::put("/product/{id}",[ProductController::class , "update"]);
  Route::get("/product/dashboard",[Productcontroller::class , "dashboard"]);
  Route::post("/product/transaction",[Productcontroller::class , "transaction"]);

  Route::get("/logout",[AuthController::class , "logout"]);
});
