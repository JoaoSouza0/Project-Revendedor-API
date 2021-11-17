<?php

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::get('products', 'api\ProductsController@index'); // All products
Route::get('products/{product_id}', 'api\ProductsController@show'); // get a specific product
Route::post('products', 'api\ProductsController@store'); // post a new product
Route::delete('products/{product_id}', 'api\ProductsController@destroy'); // delete product
Route::put('products/{product_id}', 'api\ProductsController@update'); // update product

Route::post('user', 'api\UserController@store'); // post a new user
Route::get('user/transaction/{profile}/{id}', 'api\UserController@showTransaction'); // get transaction depends on user
Route::get('user/products/{id}', 'api\ProductsController@showProductUser'); // get products user
Route::get('user', 'api\UserController@show'); // get  user
Route::put('user/{user_id}', 'api\UserController@update'); // update user

Route::post('transacao', 'api\TransactionController@store'); // post a new transaction
Route::get( 'transacao/{id}', 'api\TransactionController@show' );

