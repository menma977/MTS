<?php

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
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');

Route::post('login', 'Api\UserController@login');

Route::post('/request/password', 'Api\UserController@requestPassword');

Route::get('/binary/show/{id}', 'WebViewController@binaryShow')->name('binaryShow');

Route::middleware('auth:api')->group(function () {

  Route::group(['prefix' => 'android', 'as' => 'android.'], static function () {
    Route::get('/gallery/{id}', 'WebViewController@gallery')->name('gallery');
    Route::get('/binary', 'WebViewController@binary')->name('binary');
    Route::get('/ledger/{type}', 'WebViewController@ledger')->name('ledger');
    Route::get('/pin', 'WebViewController@pin')->name('pin');
  });

  Route::post('register', 'Api\UserController@register');

  Route::get('verification', 'Api\UserController@verification');

  Route::get('logout', 'Api\UserController@logout');

  Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('show', 'Api\UserController@show')->name('show');
    Route::get('balance', 'Api\UserController@balance')->name('balance');
    Route::post('update', 'Api\UserController@update')->name('update');
    Route::post('update/profile/image', 'Api\UserController@updateImage')->name('updateImage');
    Route::post('update/profile/data', 'Api\UserController@updateData')->name('updateData');
  });

  Route::group(['prefix' => 'withdraw', 'as' => 'withdraw.'], function () {
    Route::get('show', 'Api\UserController@withdrawValidate')->name('show');
    Route::post('store', 'Api\UserController@withdraw')->name('store');
  });

  Route::group(['prefix' => 'tree', 'as' => 'tree.'], function () {
    Route::post('show', 'Api\UserController@checkTree')->name('show');
    Route::post('store', 'Api\UserController@requestTree')->name('store');
    Route::get('gallery', 'Api\UserController@gallery')->name('gallery');
    Route::post('transfer', 'Api\UserController@transfer')->name('transfer');
  });
});
