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

// Route::get('/', function () {
//     return view('welcome');
// });

// login
Route::get('login', 'AuthUserController@login')->name('login');
Route::post('login', 'AuthUserController@getlogin')->name('checklogin');
// register
Route::get('register', 'AuthUserController@register')->name('register');
Route::post('register', 'AuthUserController@getregister')->name('checkregister');

Route::get('logout', 'AuthUserController@logout')->name('logout');

Route::group(['prefix' => 'admin', 'middleware'=> ['check:admin', 'auth']], function () {
    Route::group(['prefix' => 'product'], function () {
        Route::get('/', 'ProductController@index')->name('product');
        Route::get('/list', 'ProductController@list');
        Route::get('/detail', 'ProductController@detail')->name('detailproduct');
        Route::get('/edit', 'ProductController@edit')->name('editproduct');
        Route::get('/form', 'ProductController@form')->name('formproduct');
        Route::post('/save', 'ProductController@save')->name('saveproduct');
        Route::post('/update', 'ProductController@update')->name('updateproduct');
        Route::delete('/delete', 'ProductController@delete')->name('deleteproduct');
    });

    Route::group(['prefix' => 'costumer'], function () {
        Route::get('/', 'CostumerController@index')->name('costumer');
        Route::get('/list', 'CostumerController@list');
        Route::get('/detail', 'CostumerController@detail')->name('detailcostumer');
        Route::get('/edit', 'CostumerController@edit')->name('editcostumer');
        Route::get('/form', 'CostumerController@form')->name('formcostumer');
        Route::post('/save', 'CostumerController@save')->name('savecostumer');
        Route::post('/update', 'CostumerController@update')->name('updatecostumer');
        Route::delete('/delete', 'CostumerController@delete')->name('deletecostumer');
    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('/', 'OrderController@index')->name('order');
        Route::get('/list', 'OrderController@list');
        Route::get('/detail', 'OrderController@detail')->name('detailorder');
    });
});

Route::group(['prefix' => 'costumer', 'middleware'=> ['check:costumer', 'auth']], function () {
    Route::get('/product', 'Costumer\ProductController@index')->name('cproduct');
    Route::get('/list', 'Costumer\ProductController@list');
    Route::get('/productdetail', 'Costumer\ProductController@detail')->name('cdetailproduct');
    Route::get('/form', 'Costumer\OrderController@form')->name('cformorder');
    Route::post('/save', 'Costumer\OrderController@save')->name('csaveorder');
});
