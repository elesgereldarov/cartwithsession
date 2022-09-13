<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;


Route::get('/', [StoreController::class, 'storeList']);
Route::post('/add', [StoreController::class, 'store']);
Route::put('/change', [StoreController::class, 'update']);
Route::post('/delete', [StoreController::class, 'Delete']);


Route::get('/product', [ProductController::class, 'productList']);
Route::post('/product/add', [ProductController::class, 'store']);
Route::put('/product/change', [ProductController::class, 'update']);
Route::post('/product/delete', [ProductController::class, 'Delete']);



Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');




//Route::get('/', [ProductController::class, 'productList'])->name('products.list');
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
// Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
// Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
