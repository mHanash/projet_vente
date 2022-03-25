<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DistributionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Models\Store;
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

    Route::prefix('sales')->group(function(){
        Route::get('/vente',[SaleController::class, 'index'])->name('sale');
        Route::post('/vente',[SaleController::class, 'store'])->name('sale.store');
        Route::get('/vente/all',[SaleController::class, 'show'])->name('sale.show');
    });

    Route::get('/product',[ProductController::class,'index'])->name('product');
    Route::post('/product',[ProductController::class,'store'])->name('product.store');
    Route::get('/product/{id}',[ProductController::class,'edit'])->name('product.edit')->where('id','[0-9]+');
    Route::post('/product/update',[ProductController::class,'update'])->name('product.update');
    Route::delete('/product/{id}',[ProductController::class,'destroy'])->name('product.delete')->where('id','[0-9]+');

    Route::get('/personal',[UserController::class,'index'])->name('personal');
    Route::post('/personal',[UserController::class,'store'])->name('personal.store');
    Route::get('/personal/{id}',[UserController::class,'edit'])->name('personal.edit')->where('id','[0-9]+');
    Route::delete('/personal/{id}',[UserController::class,'destroy'])->name('personal.delete')->where('id','[0-9]+');
    Route::post('/personal/update',[UserController::class,'update'])->name('personal.update');

    Route::get('/type',[TypeController::class,'index'])->name('type');
    Route::post('/type',[TypeController::class,'store'])->name('type.store');
    Route::get('/type/{id}',[TypeController::class,'edit'])->name('type.edit')->where('id','[0-9]+');
    Route::delete('/type/{id}',[TypeController::class,'destroy'])->name('type.delete')->where('id','[0-9]+');
    Route::post('/type/update',[TypeController::class,'update'])->name('type.update');

    Route::get('/category',[CategoryController::class,'index'])->name('category');
    Route::post('/category',[CategoryController::class,'store'])->name('category.store');
    Route::get('/category/{id}',[CategoryController::class,'edit'])->name('category.edit')->where('id','[0-9]+');
    Route::delete('/category/{id}',[CategoryController::class,'destroy'])->name('category.delete')->where('id','[0-9]+');
    Route::post('/category/update',[CategoryController::class,'update'])->name('category.update');

    Route::get('/customer',[CustomerController::class,'index'])->name('customer');
    Route::post('/customer',[CustomerController::class,'store'])->name('customer.store');
    Route::get('/customer/{id}',[CustomerController::class,'edit'])->name('customer.edit')->where('id','[0-9]+');
    Route::delete('/customer/{id}',[CustomerController::class,'destroy'])->name('customer.delete')->where('id','[0-9]+');
    Route::post('/customer/update',[CustomerController::class,'update'])->name('customer.update');

    Route::get('/distribution',[DistributionController::class,'index'])->name('distribution');
    Route::post('/distribution/update/{id}',[DistributionController::class,'update'])->name('distribution.update')->where('id','[0-9]+');
    Route::post('/distribution',[DistributionController::class,'store'])->name('distribution.store');
    Route::get('/distribution/{id}',[DistributionController::class,'show'])->name('distribution.show')->where('id','[0-9]+');
    Route::delete('/distribution/{id}',[DistributionController::class,'destroy'])->name('distribution.delete')->where('id','[0-9]+');
    Route::get('/distribution/{name}/{id}',[DistributionController::class,'edit'])->name('distribution.edit')->where('id','[0-9]+');
    Route::post('/distribution/{id}',[DistributionController::class,'storeProduct'])->name('distribution.product')->where('id','[0-9]+');
    Route::delete('/distribution/{name}/{id}',[DistributionController::class,'deleteProduct'])->name('distribution.delete.product');

    Route::get('/store',[StoreController::class,'index'])->name('store');
    Route::get('/store/{id}/{product}',[StoreController::class,'editProduct'])->name('store.edit.product')->where(['id'=>'[0-9]+','product'=>'[0-9]+']);
    Route::get('/store/{name}/{id}',[StoreController::class,'edit'])->name('store.edit')->where('id','[0-9]+');
    Route::post('/store',[StoreController::class,'store'])->name('store.store');
    Route::post('/store/{id}',[StoreController::class,'storeProduct'])->name('store.store.product')->where('id','[0-9]+');
    Route::get('/store/{id}',[StoreController::class,'show'])->name('store.show')->where('id','[0-9]+');
    Route::delete('/store/{id}',[StoreController::class,'destroy'])->name('store.delete')->where('id','[0-9]+');
    Route::post('/store/{id}/{product}',[StoreController::class,'updateProduct'])->name('store.update.product')->where(['id'=>'[0-9]+','product'=>'[0-9]+']);
    Route::post('/store/update/{id}',[StoreController::class,'update'])->name('store.update');
    Route::delete('/store/{name}/{id}',[StoreController::class,'deleteProduct'])->name('store.delete.product');


    Route::get('/setting',[SettingController::class,'index'])->name('setting');
    Route::post('/setting/target',[SettingController::class,'store'])->name('setting.store');
    Route::get('/setting/{id}',[SettingController::class,'edit'])->name('setting.edit')->where('id','[0-9]+');
    Route::post('/setting/{id}',[SettingController::class,'update'])->name('setting.update');
    Route::delete('/setting/{id}',[SettingController::class,'destroy'])->name('setting.delete')->where('id','[0-9]+');

    Route::get('/type',[TypeController::class,'index'])->name('type');
    Route::post('/type',[TypeController::class,'store'])->name('type.store');
    Route::get('/type/{id}',[TypeController::class,'edit'])->name('type.edit')->where('id','[0-9]+');
    Route::post('/type/update',[TypeController::class,'update'])->name('type.update');
    Route::delete('/type/{id}',[TypeController::class,'destroy'])->name('type.delete')->where('id','[0-9]+');

    Route::get('/category',[CategoryController::class,'index'])->name('category');
    Route::post('/category',[CategoryController::class,'store'])->name('category.store');
    Route::get('/category/{id}',[CategoryController::class,'edit'])->name('category.edit')->where('id','[0-9]+');
    Route::post('/category/update',[CategoryController::class,'update'])->name('category.update');
    Route::delete('/category/{id}',[CategoryController::class,'destroy'])->name('category.delete')->where('id','[0-9]+');



});

require __DIR__.'/auth.php';
