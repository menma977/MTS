<?php

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

Route::get('/', 'FrontEndController@index')->name('index');
Route::get('/public', 'FrontEndController@index')->name('index');

Route::group(['prefix' => 'config', 'as' => 'config.'], static function () {
  Route::get('/', 'HomeController@isOnlineStatus')->name('isOnlineStatus');
  Route::get('/user/status', 'HomeController@authOnline')->name('authOnline');
});

Route::get('/certificate/{id}', 'WebViewController@generateData')->name('generateDatas');

Auth::routes(['register' => false]);

Route::middleware(['online', 'auth'])->group(static function () {
  Route::get('/pin', 'WebViewController@pin')->name('pin')->middleware('auth');

  Route::get('/home', 'HomeController@index')->name('home');

  Route::group(['prefix' => 'email', 'as' => 'email.'], static function () {
    Route::get('/order', 'EmailController@order')->name('order');
    Route::get('/register', 'EmailController@register')->name('register');
  });

  Route::group(['prefix' => 'banner', 'as' => 'banner.'], static function () {
    Route::get('/', 'BannerController@index')->name('index')->middleware('auth', 'role:1');
    Route::post('/store', 'BannerController@store')->name('store')->middleware('auth', 'role:1');
    Route::get('/delete', 'BannerController@delete')->name('delete')->middleware('auth', 'role:1');
  });

  Route::group(['prefix' => 'user', 'as' => 'user.'], static function () {
    Route::get('/', 'UserController@index')->name('index')->middleware('auth', 'role:1');
    Route::get('/create', 'UserController@create')->name('create')->middleware('auth', 'role:1');
    Route::post('/store', 'UserController@store')->name('store')->middleware('auth', 'role:1');
    Route::get('/edit/{id}/password', 'UserController@editPassword')->name('editPassword')->middleware('auth', 'role:1');
    Route::post('/update/{id}/password', 'UserController@updatePassword')->name('updatePassword')->middleware('auth', 'role:1');
    Route::get('/show/{id}', 'UserController@show')->name('show')->middleware('auth', 'role:1');
    Route::get('/update/{id}/{status}', 'UserController@update')->name('update')->middleware('auth', 'role:1');
    Route::post('/role/update/{id}', 'UserController@roleUpdate')->name('roleUpdate')->middleware('auth', 'role:1');
    Route::get('/delete/{id}', 'UserController@destroy')->name('delete')->middleware('auth', 'role:1');
    Route::post('/pin/send', 'UserController@sendCode')->name('sendCode')->middleware('auth', 'role:1');
  });

  Route::group(['prefix' => 'tree', 'as' => 'tree.'], static function () {
    Route::get('/', 'TreeController@index')->name('index')->middleware('auth', 'role:1');
    Route::get('/pey/{id}', 'TreeController@pay')->name('pay')->middleware('auth', 'role:1');
    Route::post('/store', 'TreeController@store')->name('store')->middleware('auth', 'role:1');
    Route::get('/show/{username}', 'TreeController@show')->name('show')->middleware('auth', 'role:1');
    Route::post('/harvest/{id}', 'TreeController@harvest')->name('harvest')->middleware('auth', 'role:1');
    Route::get('/{id}/update/{status}', 'TreeController@update')->name('update')->middleware('auth', 'role:1');
    Route::get('/delete/{id}', 'TreeController@destroy')->name('delete')->middleware('auth', 'role:1');
    Route::post('/qr', 'TreeController@QRCodeList')->name('QRCodeList')->middleware('auth', 'role:1');
    Route::get('/qr/{id}', 'TreeController@QRCode')->name('QRCode')->middleware('auth', 'role:1');
    Route::post('/gallery/{id}', 'TreeController@uploadToGallery')->name('uploadToGallery')->middleware('auth', 'role:1');
    Route::get('/map/{id}', 'TreeController@showMap')->name('showMap')->middleware('auth', 'role:1');
    Route::post('/save/map/{id}', 'TreeController@storeMap')->name('storeMap')->middleware('auth', 'role:1');
    Route::get('/certivicate/{id}', 'TreeController@generateData')->name('generateData')->middleware('auth', 'role:1');
  });

  Route::group(['prefix' => 'ledger', 'as' => 'ledger.'], static function () {
    Route::get('/', 'LedgerController@index')->name('index')->middleware('auth', 'role:1');
    Route::get('/create', 'LedgerController@create')->name('create')->middleware('auth', 'role:1');
    Route::post('/store', 'LedgerController@store')->name('store')->middleware('auth', 'role:1');
    Route::get('/show/{id}', 'LedgerController@show')->name('show')->middleware('auth', 'role:1');
    Route::get('/edit/{id}', 'LedgerController@edit')->name('edit')->middleware('auth', 'role:1');
    Route::post('/update/{id}', 'LedgerController@update')->name('update')->middleware('auth', 'role:1');
    Route::get('/delete/{id}', 'LedgerController@destroy')->name('delete')->middleware('auth', 'role:1');
  });

  Route::group(['prefix' => 'withdraw', 'as' => 'withdraw.'], static function () {
    Route::get('/', 'WithdrawController@index')->name('index')->middleware('auth', 'role:1');
    Route::get('/{id}/update/{status}', 'WithdrawController@update')->name('update')->middleware('auth', 'role:1');
  });

  Route::group(['prefix' => 'binary', 'as' => 'binary.'], static function () {
    Route::get('/', 'BinaryController@index')->name('index')->middleware('auth', 'role:1|2|3|4');
    Route::get('/find/{id}', 'BinaryController@show')->name('show')->middleware('auth');
  });

});