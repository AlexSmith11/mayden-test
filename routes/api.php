<?php

use App\Http\Controllers\AuthController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/user/spending_limit', [AuthController::class , 'spendingLimitAction']);

    Route::post('/logout', [AuthController::class, 'logoutAction']);

    Route::get('/cart', [CartController::class, 'indexAction']); // contains list of all items, spending limit and the total price
    Route::post('/cart/email', [CartController::class, 'emailAction']);

    Route::get('/cart/item/{cartItem}', [CartItemController::class, 'readAction']);
    Route::post('/cart/item', [CartItemController::class, 'createAction']);
    Route::delete('/cart/item/{cartItem}', [CartItemController::class, 'deleteAction']);
    Route::patch('/cart/item/remove/{cartItem}', [CartItemController::class, 'crossAction']);
    Route::patch('/cart/item/reorder/{cartItem}', [CartItemController::class, 'reorderAction']);
});

// Public routes
Route::post('/register', [AuthController::class, 'registerAction']);
Route::post('/login', [AuthController::class, 'loginAction']);

Route::post('/product/search', [ProductController::class, 'searchAction']);

