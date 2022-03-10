<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product();
        $product->tesco_id = 10;
        $product->name = 'big cheese';
        $product->image = 'www.fakeurl.com';
        $product->department = 'cheese dept';
        $product->description = 'cheese description!';
        $product->price = 0.99;
        $product->saveOrFail();

        $product = new Product();
        $product->tesco_id = 11;
        $product->name = 'big fish';
        $product->image = 'www.fakeurl.com';
        $product->department = 'fish dept';
        $product->description = 'fish description!';
        $product->price = 1.99;
        $product->saveOrFail();

        $product = new Product();
        $product->tesco_id = 17;
        $product->name = 'wagon wheel';
        $product->image = 'www.imgur/image/fakeimage.com';
        $product->department = 'biscuit dept';
        $product->description = 'wagon wheel description!';
        $product->price = 0.79;
        $product->saveOrFail();
    }
}
