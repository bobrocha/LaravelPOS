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

// Inventory > Categories
Route::get('inventory/categories', 'Inventory\Categories\CategoriesController@index')->name('inventory_categories');
Route::get('inventory/categories/get', 'Inventory\Categories\CategoriesController@getAll');
Route::post('inventory/categories/create/{title}', 'Inventory\Categories\CategoriesController@create')->name('inventory_categories_store');
Route::post('inventory/categories/destroy/{category}', 'Inventory\Categories\CategoriesController@destroy')->name('inventory_categories_destroy');
Route::post('inventory/categories/update/{id}/{title}', 'Inventory\Categories\CategoriesController@update');

Route::get('/foo', 'inventory\FooController@index');
Route::get('/bar', 'BarController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
