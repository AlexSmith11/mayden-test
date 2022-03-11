<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartItemResource;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Resources\Json\JsonResource;

class CartController extends Controller
{
    // @TODO: only return current users items
    public function indexAction(Cart $cart)
    {
        return new CartResource($cart);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAction()
    {
        //
    }

    /**
     * Send an email of the product list to a given address
     */
    public function emailAction()
    {
        $cart = Cart::all();
    }
}
