<?php

namespace Database\Seeders;

use App\Models\CartItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cartItem = new CartItem();
        $cartItem->cart_id = 1;
        $cartItem->product_id = 1;
        $cartItem->quantity = 3;
        $cartItem->display = true;
        $cartItem->saveOrFail();

        $cartItem = new CartItem();
        $cartItem->cart_id = 1;
        $cartItem->product_id = 2;
        $cartItem->rank = 1;
        $cartItem->quantity = 5;
        $cartItem->display = false;
        $cartItem->saveOrFail();
    }
}
