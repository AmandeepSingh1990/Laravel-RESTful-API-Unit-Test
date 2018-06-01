<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', 'CategoryController@index');
    Route::get('list', 'CategoryController@list');
    Route::post('/', 'CategoryController@store');
    Route::get('{id}', 'CategoryController@show');
    Route::patch('{id}', 'CategoryController@update');
    Route::delete('{id}', 'CategoryController@destroy');
});
