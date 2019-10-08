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

Route::get('/', function () {
	return view('welcome');
});


Route::get('/josh', 'RegisterController@validate');

Route::get('/test', function() {
	return 'foo';
});

// Inventory > Items
// Route::get('/products', 'Inventory\Products\ProductsController@index');
// Route::get('/products/add', 'Inventory\Products\ProductsController@add');

// Inventory > Categories
Route::get('/categories', 'Inventory\Categories\CategoriesController@index');
Route::get('/categories/add', 'Inventory\Categories\CategoriesController@add');

Route::get('/foo', 'inventory\FooController@index');
Route::get('/bar', 'BarController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
