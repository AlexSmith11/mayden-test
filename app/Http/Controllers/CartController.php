<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Mail\CartMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function indexAction()
    {
        return new CartResource(Auth::user()->cart);
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
