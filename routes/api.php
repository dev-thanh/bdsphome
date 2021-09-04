<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\CartController;

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

Route::group(['namespace' => 'Api'], function () {

	Route::get('/get-cart', 'CartController@getCart')->name('home.get-cart');

	Route::get('/get-add-cart', 'CartController@getAddCart')->name('home.get-add-cart');

	Route::post('/post-add-cart', 'CartController@postAddCart')->name('home.post-add-cart');

	Route::post('/post-test', 'CartController@postTest')->name('home.post-test');
});


