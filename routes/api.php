<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SellerController;
// use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\SellerAuthController;
// use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Seller\ProductController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('admin/login',[AdminAuthController::class,'login']);

Route::middleware(['auth:sanctum','role:admin'])->group(function(){
    Route::post('admin/seller',[SellerController::class,'store']);
    Route::get('admin/sellers',[SellerController::class,'index']);
});

Route::post('seller/login',[SellerAuthController::class,'login']);

Route::middleware(['auth:sanctum','role:seller'])->group(function(){
    Route::post('seller/product',[ProductController::class,'store']);
    Route::get('seller/products',[ProductController::class,'index']);
    Route::get('seller/product/{id}/pdf',[ProductController::class,'pdf']);
    Route::delete('seller/product/{id}',[ProductController::class,'destroy']);
});
