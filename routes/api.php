<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user/spending_limit', [CartController::class , 'spendingLimitAction']); //@todo: REPLACE CartCont with UserCont

Route::post('/product/search', [ProductController::class, 'searchAction']);

Route::get('/cart/{cart}', [CartController::class, 'indexAction']); // contains both list of all items and the total price
Route::post('/cart/create', [CartController::class, 'createAction']); //? only needed on new user creation, user shouldn't be able to do this manually
Route::post('/cart/email', [CartController::class, 'emailAction']);

Route::get('/cart/item/{cartItem}', [CartItemController::class, 'readAction']);
Route::post('/cart/item', [CartItemController::class, 'createAction']);
Route::delete('/cart/item/{cartItem}', [CartItemController::class, 'deleteAction']);
Route::patch('/cart/item/remove/{cartItem}', [CartItemController::class, 'crossAction']);
Route::patch('/cart/item/reorder/{cartItem}', [CartItemController::class, 'reorderAction']);

