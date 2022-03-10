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
     *
     * Because we are using a separate DB for products (Tesco), we will also use this action to store the prod in our own DB.
     * @TODO: make sure we do not duplicate products - check if it is already in the DB
     */
    public function createAction()
    {
        // require: product id (tesco product id), plus rest of product object e.g. description, name, etc -
        // REMEMBER: the user must first have performed a search so must have the required product info.
        // save product to db
        // create new CartItem and assign to product (not tesco_id, our product id).
        // get the users cart i.e. Auth::me
        // assign CartItem to users cart
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
