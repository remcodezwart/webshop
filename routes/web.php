<?php

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

Route::get('/', 'ProductController@index')->name('AllProducts');
Route::get('/product/tag/{tagname}', 'ProductController@search')->name('search');
Route::get('/product/name/{name}', 'ProductController@show')->name('product');
Route::get('/categories', 'CategoryController@index')->name('AllCategories');

Route::post('/api/cart', 'ProductController@cartAdd')->name('cartAdd');
Route::get('/api/cart', 'ProductController@getCart')->name('cartGet');
Route::post('/api/cart/delete',  'ProductController@deleteFromCart')->name('deleteFromCart');
Route::post('/api/cart/edit', 'ProductController@editFromCart')->name('editFromCart');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@modifyClient')->name('modifyClient');
Route::get('/orders/{id}', 'OrderController@order')->name('order');
Route::get('/orders', 'OrderController@index')->name('orders');
Route::post('/orders/create', 'OrderController@placeOrder')->name('placeOrder');
