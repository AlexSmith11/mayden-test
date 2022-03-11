<?php

use App\Http\Controllers\CartController;
use App\Mail\CartMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

//Route::get('/cart/email', function() {
//    Mail::to('alexsmith11nd@gmail.com')->send(new CartMail());
//    return redirect('/');
//});
