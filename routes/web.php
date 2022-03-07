<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DistributionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Route as RoutingRoute;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return redirect()->route('login.index');
});

Route::middleware('auth')->group(function(){
    Route::get('/admin',[HomeController::class,'index'])->name('index');

    Route::get('/product',[ProductController::class,'index'])->name('product');
    Route::get('/product/{id}',[ProductController::class,'edit'])->name('product.edit');

    Route::get('/personal',[UserController::class,'index'])->name('personal');
    Route::get('/personal/{id}',[UserController::class,'edit'])->name('personal.edit');

    Route::get('/customer',[CustomerController::class,'index'])->name('customer');
    Route::get('/customer/{id}',[CustomerController::class,'edit'])->name('customer.edit');

    Route::get('/distribution',[DistributionController::class,'index'])->name('distribution');
    Route::get('/distribution/{id}',[DistributionController::class,'edit'])->name('distribution.edit');

    Route::get('/store/{name}',[StoreController::class,'index'])->name('store');
    Route::get('/store/{name}/{id}',[StoreController::class,'edit'])->name('store.edit');


});

require __DIR__.'/auth.php';
