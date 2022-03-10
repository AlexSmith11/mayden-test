<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductSearchRequest;
use App\Http\Resources\ProductSearchResource;
use App\Models\Product;
use App\Clients\TescoClient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a list of returned products.
     *
     */
    public function searchAction(ProductSearchRequest $request)
    {
        $data = $request->json()->all();

        $client = app()->make(TescoClient::class);
        $results = $client->search($data['search_term']);

        $products = $results->uk->ghs->products->results;
        $total = count($products);

        $resources = [];
        foreach ($products as $product) {
            $resources[] = new ProductSearchResource($product);
        }
        $resources[] = ['meta' => [
            'total_products' => $total
        ]];

        return $resources;
    }

}
