<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        if (count($products) > 0) {
            return response()->json([
                'success' => true,
                'categories' => ProductResource::collection($products),
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no products',
            ], 200);
        }
    }
}
