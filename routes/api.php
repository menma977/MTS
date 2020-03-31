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

Route::post('login', 'Api\UserController@login');

Route::middleware('auth:api')->group(function () {

  Route::group(['prefix' => 'android', 'as' => 'android.'], static function () {
    Route::get('/gallery/{id}', 'WebViewController@gallery')->name('gallery')->middleware('auth');
    Route::get('/binary', 'WebViewController@binary')->name('binary')->middleware('auth');
    Route::get('/ledger/{type}', 'WebViewController@ledger')->name('ledger')->middleware('auth');
    Route::get('/pin', 'WebViewController@pin')->name('pin')->middleware('auth');
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
  });
});
