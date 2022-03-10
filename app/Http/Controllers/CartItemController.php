<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemRequest;
use App\Models\CartItem;
use App\Models\Product;

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
    public function createAction(CartItemRequest $request)
    {
        // require: product id (tesco product id), plus rest of product object e.g. description, name, etc -
        // REMEMBER: the user must first have performed a search so must have the required product info.
        $data = $request->json()->all();
        $tescoId = $data['tesco_id'];
        $product = Product::where('tesco_id', $tescoId)->first();

        // add product to DB if we do not already have a copy
        if($product == null) {
            $product = new Product();
            $product->tesco_id = $data['tesco_id'];
            $product->name = $data['name'];
            $product->image = $data['image'];
            $product->department = $data['department'];
            $product->description = $data['description'];
            $product->price = $data['price'];
            $product->saveOrFail();
        }

        // create new CartItem and assign to product (not tesco_id, our product id).
        $cartItem = new CartItem();

        // get the users Cart i.e. Auth::me->cart and assign CartItem to users cart
        $cartItem;

        // complete rest of CartItem details and save / return
        $cartItem->product_id = $product->id;
        $cartItem->quantity = $product->quantity;
        $cartItem->saveOrFail();

        return $cartItem;
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
