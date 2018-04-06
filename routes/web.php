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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
