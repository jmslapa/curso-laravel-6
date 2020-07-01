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

Route::middleware(['auth', 'is.admin'])
                ->match(['get', 'post'], '/products/search', 'ProductController@search')
                ->name('products.search');

Route::middleware(['auth', 'is.admin'])
                ->resource('/products', 'ProductController');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);
