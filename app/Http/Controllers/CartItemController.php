<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartItemRequest;
use App\Http\Requests\UpdateCartItemRequest;
use App\Models\CartItem;

class CartItemController extends Controller
{
    /**
     * Read
     */
    public function indexAction()
    {
        //
    }

    /**
     * Add item to cart
     */
    public function createAction()
    {
        //
    }

    public function deleteAction(CartItem $cartItem)
    {
        //
    }

    /**
     * Disable an item in the users cart
     */
    public function crossAction()
    {

    }

    /**
     * Reorder a product in the cart
     */
    public function reorderAction()
    {

    }
}
