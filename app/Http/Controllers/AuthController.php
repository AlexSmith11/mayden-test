<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerAction(Request $request) {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        // Create and assign cart to the user
        $cart = new Cart();
        $cart->user_id = $user->id;
        $cart->saveOrFail();

        $token = $user->createToken('myAppToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function loginAction(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // check email
        $user = User::where('email', $data['email'])->first();

        // check pw
        if(!$user || !Hash::check($data['password'], $user->password)) {
            return new JsonResponse([
                'message' => 'invalid credentials'
            ], 401);
        }

        $token = $user->createToken('myAppToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logoutAction(Request $request)
    {
        auth()->user()->tokens()->delete();

        return new JsonResponse(
            [
                'message' => 'logged out'
            ],
            200
        );
    }

    /**
     * Create or update the users spending limit
     */
    public function spendingLimitAction(Request $request)
    {
        $data = $request->validate([
            'spending_limit' => 'required|numeric',
        ]);
        $me = Auth::user();
        $me->spending_limit = $data['spending_limit'];
        $me->saveOrFail();

        return new JsonResponse(['message' => 'spending limit updated'], 200);
    }
}
