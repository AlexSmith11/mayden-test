<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Mail\CartMail;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    // @TODO: only return current users items
    public function indexAction(Cart $cart)
    {
        return new CartResource($cart);
    }

    /**
     * Create a new cart - this is tied to the user. When a new user is created, a cart assigned to them should also.
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
    public function emailAction(Request $request)
    {
        $data = $request->json()->all();
        $recipient = $data['recipient'];

        Mail::to($recipient)->send(new CartMail());
        return 'A message has been sent to Mailtrap.';
    }
}
