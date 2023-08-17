<?php

use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\KasirController;
use App\Models\product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function(){
    return redirect('/sign-in');
});
Route::middleware('auth')->group(function(){
    Route::get('/dashboard',[KasirController::class , 'dashboard']);
    Route::get('/produk',[KasirController::class, 'products']);
    Route::get('/transaksi',[KasirController::class, 'transaction']);
    Route::get('/kasir',[KasirController::class, 'cashier']);
    Route::post('/logout',[AuthenticateController::class, 'logout']);
});

Route::middleware('guest')->group(function(){
    Route::get('/sign-in',[AuthenticateController::class, 'createSignIn'])->name('login');
    Route::post('/sign-in',[AuthenticateController::class, 'storeSignIn']);
    Route::get('/sign-up',[AuthenticateController::class , 'createSignUp']);
    Route::post('/sign-up',[AuthenticateController::class , 'storeSignUp']);
});

// Route::get('/test', function(){
//     $wrapper =[

//     ];

//     $product = product::where('barqode',4892894629)->first();


//     array_push($wrapper,$product);

//     array_push($wrapper,$product2);

//     return response($wrapper);

// });
