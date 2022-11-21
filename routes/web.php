<?php

use App\Http\Controllers\Admin\AddressesController;
use App\Http\Controllers\Admin\BannersController;
use App\Http\Controllers\Admin\Categorycontroller;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'isAdmin'], function () {

    Route::get('/', [UsersController::class, 'home'])->name('admin.users');
    // Users
    Route::get('/users', [UsersController::class, 'index'])->name('admin.users');
    Route::get('/user/create', [UsersController::class, 'create'])->name('admin.user.create');
    Route::post('/user/store', [UsersController::class, 'store'])->name('admin.user.store');
    Route::get('/user/edit/{id}', [UsersController::class, 'edit'])->name('admin.user.edit');
    Route::post('/user/update/{id}', [UsersController::class, 'update'])->name('admin.user.update');
    Route::get('/user/destroy/{id}', [UsersController::class, 'destroy'])->name('admin.user.destroy');

    // // Addresses
    // Route::get('/addresses', [AddressesController::class, 'index'])->name('admin.addresses');
    // Route::get('/address/create', [AddressesController::class, 'create'])->name('admin.address.create');
    // Route::post('/address/store', [AddressesController::class, 'store'])->name('admin.address.store');
    // Route::get('/address/edit/{id}', [AddressesController::class, 'edit'])->name('admin.address.edit');
    // Route::post('/address/update/{id}', [AddressesController::class, 'update'])->name('admin.address.update');
    // Route::get('/address/destroy/{id}', [AddressesController::class, 'destroy'])->name('admin.address.destroy');

    // // News
    // Route::get('/news', [NewsController::class, 'index'])->name('admin.news');
    // Route::get('/news/create', [NewsController::class, 'create'])->name('admin.news.create');
    // Route::post('/news/store', [NewsController::class, 'store'])->name('admin.news.store');
    // Route::get('/news/edit/{id}', [NewsController::class, 'edit'])->name('admin.news.edit');
    // Route::post('/news/update/{id}', [NewsController::class, 'update'])->name('admin.news.update');
    // Route::get('/news/destroy/{id}', [NewsController::class, 'destroy'])->name('admin.news.destroy');

    // Cities
    Route::get('/cities', [CityController::class, 'index'])->name('admin.cities');
    Route::get('/city/create', [CityController::class, 'create'])->name('admin.city.create');
    Route::post('/city/store', [CityController::class, 'store'])->name('admin.city.store');
    Route::get('/city/edit/{id}', [CityController::class, 'edit'])->name('admin.city.edit');
    Route::post('/city/update/{id}', [CityController::class, 'update'])->name('admin.city.update');
    Route::get('/city/destroy/{id}', [CityController::class, 'destroy'])->name('admin.city.destroy');


    // Banners
    Route::get('/banners', [BannersController::class, 'index'])->name('admin.banners');
    Route::get('/banner/create', [BannersController::class, 'create'])->name('admin.banner.create');
    Route::post('/banner/store', [BannersController::class, 'store'])->name('admin.banner.store');
    Route::get('/banner/edit/{id}', [BannersController::class, 'edit'])->name('admin.banner.edit');
    Route::post('/banner/update/{id}', [BannersController::class, 'update'])->name('admin.banner.update');
    Route::get('/banner/destroy/{id}', [BannersController::class, 'destroy'])->name('admin.banner.destroy');

    // Categories
    Route::get('/categories', [Categorycontroller::class, 'index'])->name('admin.categories');
    Route::get('/category/create', [Categorycontroller::class, 'create'])->name('admin.category.create');
    Route::post('/category/store', [Categorycontroller::class, 'store'])->name('admin.category.store');
    Route::get('category/{id}', [Categorycontroller::class, 'show'])->name('admin.category');
    Route::get('/category/edit/{id}', [Categorycontroller::class, 'edit'])->name('admin.category.edit');
    Route::post('/category/update/{id}', [Categorycontroller::class, 'update'])->name('admin.category.update');
    Route::get('/category/destroy/{id}', [Categorycontroller::class, 'destroy'])->name('admin.category.destroy');

    // products
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
    Route::get('/product/create', [ProductController::class, 'create'])->name('admin.product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::get('/product/destroy/{id}', [ProductController::class, 'destroy'])->name('admin.product.destroy');

    //Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('/accepted_orders', [OrderController::class, 'accepted'])->name('admin.orders.accepted');
    Route::get('/rejected_orders', [OrderController::class, 'rejected'])->name('admin.orders.rejected');
    Route::get('/order/{id}', [OrderController::class, 'show'])->name('admin.order.details');
    Route::post('/order/status/{id}', [OrderController::class, 'changeStatus'])->name('order.status');

    //Notifications
    Route::get('/noti', [NotificationController::class, 'noti'])->name('admin.noti');
    Route::post('/push', [NotificationController::class, 'push'])->name('admin.push');

    // Settings
    // Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings');
    Route::get('/setting/edit/{id}', [SettingsController::class, 'edit'])->name('admin.setting.edit');
    Route::post('/setting/update/{id}', [SettingsController::class, 'update'])->name('admin.setting.update');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
