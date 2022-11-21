<?php

use App\Http\Controllers\Api\AddressesController;
use App\Http\Controllers\Api\BannersController;
use App\Http\Controllers\Api\Categorycontroller;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('send_code', [UserController::class, 'send_code']);
Route::post('confirm_code/{id}', [UserController::class, 'confirm_code']);
Route::post('password_reset', [UserController::class, 'password_reset']);

Route::middleware('auth:api')->group(function(){
    //profile
    Route::post('edit_profile', [UserController::class, 'editData']);
    Route::post('change_password', [UserController::class, 'change_password']);
    Route::get('profile', [UserController::class, 'profile']);

    Route::post('/add_address', [AddressesController::class, 'store']);
    Route::put('/edit_address/{id}', [AddressesController::class, 'update']);
    Route::post('/del_address/{id}', [AddressesController::class, 'destroy']);
    Route::get('/user_addresses', [AddressesController::class, 'user_addresses']);
    Route::get('/address/{id}', [AddressesController::class, 'show']);

    Route::post('confirm_order', [OrderController::class, 'confirm_order']);
    Route::post('user_orders', [OrderController::class, 'user_orders']);

    // Route::post('addToCart/{id}', [CartController::class, 'addToCart']);
    // Route::post('zamzamToCart/{id}', [CartController::class, 'zamzamToCart']);
    // Route::post('masajedToCart/{id}', [CartController::class, 'masajedToCart']);
    // Route::get('cartItems', [CartController::class, 'cartItems']);
    // Route::post('addQuantity/{id}', [CartController::class, 'addQuantity']);
    // Route::post('rmQuantity/{id}', [CartController::class, 'rmQuantity']);
    // Route::post('removeItem/{id}', [CartController::class, 'removeItem']);

    // Route::post('confirm_order', [OrdersController::class, 'confirm_order']);
    // Route::get('order_details/{id}', [OrdersController::class, 'order_details']);
    // Route::get('user_orders', [OrdersController::class, 'user_orders']);
});

// Route::get('news', [NewsController::class, 'index']);
Route::get('banners', [BannersController::class, 'index']);
Route::get('categories', [Categorycontroller::class, 'index']);
// Route::get('subcategories', [SubCategoriesController::class, 'index']);
// Route::get('subcategory/{id}', [SubCategoriesController::class, 'comCat']);

Route::get('products', [ProductController::class, 'index']);
// Route::get('catproducts/{id}', [ProductsController::class, 'CatProducts']);
// Route::post('searchProducts', [ProductsController::class, 'searchProducts']);

Route::get('cities', [AddressesController::class, 'cities']);

Route::get('settings', [SettingsController::class, 'index']);

Route::get('orders', [OrderController::class, 'orders']);


