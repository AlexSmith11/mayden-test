<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemRequest;
use App\Http\Resources\CartItemResource;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    public function readAction(CartItem $cartItem)
    {
        $me = Auth::user();
        if(!isset($me->cart)) return ['message' => 'no cart found'];
        if($cartItem->cart_id !== $me->cart->id) return 401;

        return new CartItemResource($cartItem);
    }


    /**
     * Add item to cart
     *
     * Because we are using a separate DB for products (Tesco), we will also use this action to store the prod in our own DB.
     */
    public function createAction(CartItemRequest $request)
    {
        // get the product info either from DB or defacto Tesco api (given from front-end after the Tesco API search).
        $data = $request->json()->all();
        $tescoId = $data['tesco_id'];
        $product = Product::where('tesco_id', $tescoId)->first();

        // add product to DB if we do not already have a copy
        if($product == null && isset($data['name'])) {
            $product = new Product();
            $product->tesco_id = $data['tesco_id'];
            $product->name = $data['name'];
            $product->image = $data['image'];
            $product->department = $data['department'];
            $product->description = $data['description'];
            $product->price = $data['price'];   // this might be the wrong one? what is unitprice?
            $product->saveOrFail();
        }

        $cartItem = new CartItem();

        // get the users cart and assign CartItem to users cart
        $cartItem->cart_id = Auth::user()->cart->id;
        $cartItem->product_id = $product->id;
        $cartItem->quantity = $data['quantity'];
        $cartItem->saveOrFail();

        // update cart total
        $cart = Cart::where('id', $cartItem->cart_id)->firstOrFail();
        $cart->total = $cart->total + $product->price;
        $cart->saveOrFail();


        return $cartItem;
    }

    public function deleteAction(CartItem $cartItem)
    {
        $price = $cartItem->price;
        $cartId = $cartItem->cart_id;

        if($cartId !== Auth::user()->cart->id) return 401;

        $cartItem->delete();

        // update cart total
        $cart = Cart::where('id', $cartId)->firstOrFail();
        $cart->total = $cart->total - $price;
        $cart->saveOrFail();

        return new JsonResponse(['message' => 'product removed from cart'], 200);
    }

    /**
     * Disable an item in the users cart
     */
    public function crossAction(CartItem $cartItem)
    {
        if($cartItem->cart_id !== Auth::user()->cart->id) return 401;

        $cartItem->toggleDisplay();
        $cartItem->saveOrFail();
        return new JsonResponse(['message' => 'product display toggled'], 200);
    }

    /**
     * Reorder a product in the cart
     */
    public function reorderAction(Request $request, CartItem $cartItem)
    {
        $data = $request->json()->all();
        if($cartItem->cart_id !== Auth::user()->cart->id) return 401;

        $cartItem->rank = $data['rank'];
        $cartItem->saveOrFail();

        $allCartItems = CartItem::all()->toArray();

        // sort in desc order
        usort($allCartItems, fn($a, $b) => $a['rank'] > $b['rank']);

        var_dump($cartItem->id);

        for ($i = 0; $i > count($allCartItems); $i++) {
            $currentItem = $allCartItems[$i];
            $nextItem = $allCartItems[$i + 1];

//            if($cartItem->id !== $allCartItems[$i]) {
//                continue;
//            }

            var_dump($currentItem);


            // if their ranks don't clash, skip
            if($allCartItems[$i - 1]->rank !== $allCartItems[$i]->rank) {
                continue;
            }

            // as their ranks are the same, push the original item one higher in the ranking
            $allCartItems[$i]->rank += 1;


        }

        return $allCartItems;
    }
}
