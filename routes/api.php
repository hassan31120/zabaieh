<?php

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
});
