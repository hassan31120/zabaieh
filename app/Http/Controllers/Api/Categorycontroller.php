<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class Categorycontroller extends Controller
{
    public function index(){
        $cats = Category::all();
        if (count($cats) > 0) {
            return response()->json([
                'success' => true,
                'categories' => CategoryResource::collection($cats),
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no categories',
            ], 200);
        }
    }
}
