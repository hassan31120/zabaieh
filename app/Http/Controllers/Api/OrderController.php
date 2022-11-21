<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function confirm_order(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        $validator = Validator::make($data, [
            'type' => 'required',
            'product_id' => 'required',
            'address_id' => 'required',
            'prep' => 'required',
            'cutting' => 'required',
            'mafroum' => 'required',
            'head' => 'required',
            'kersh' => 'required',
            'pay_method' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }
        $data['user_id'] = $user->id;
        $data['status'] = 'pending';
        $addresses = $user->addresses;
        for ($i = 0; $i < count($addresses); $i++) {
            $ad[] = $addresses[$i]->id;
        }
        if (in_array($data['address_id'], $ad)) {
            $product = Product::find($request['product_id']);
            if ($product) {
                $order = Order::create($data);
                return response()->json([
                    'success' => true,
                    'message' => 'تم تسجيل الطلب بنجاح',
                    'order' => new OrderResource($order)
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'هذا المنتج غير موجود!'
                ], 200);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'هذا العنوان غير صالح!'
            ], 200);
        }
    }

    public function orders()
    {
        $orders  = Order::all();
        if (count($orders) > 0) {
            return response()->json([
                'success' => true,
                'orders' => OrderResource::collection($orders)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no orders'
            ], 200);
        }
    }
}
