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

Route::middleware('auth')->match(['get', 'post'], '/products/search', 'ProductController@search')->name('products.search');
Route::middleware('auth')->resource('/products', 'ProductController');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => true]);

Route::get('/home', 'HomeController@index')->name('home');
