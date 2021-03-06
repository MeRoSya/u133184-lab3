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

Route::post('/v1/addresses', 'App\Http\ApiV1\Addresses\Controllers\AddressController@create');
Route::put('/v1/addresses/{id}', 'App\Http\ApiV1\Addresses\Controllers\AddressController@replace');

Route::get('v1/customers', 'App\Http\ApiV1\Customers\Controllers\CustomerController@list');

Route::post('v1/orders', 'App\Http\ApiV1\Orders\Controllers\OrderController@create');
Route::patch('v1/orders/{id}', 'App\Http\ApiV1\Orders\Controllers\OrderController@change');
Route::delete('v1/orders/{id}', 'App\Http\ApiV1\Orders\Controllers\OrderController@delete');
