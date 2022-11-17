<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BannersResource;
use App\Models\Banner;

class BannersController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        if (count($banners) > 0) {
            return response()->json([
                'success' => true,
                'banners' => BannersResource::collection($banners)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'banners' => []
            ], 200);
        }
    }
}
