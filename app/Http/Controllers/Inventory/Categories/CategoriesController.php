<?php

namespace App\Http\Controllers\Inventory\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
	public function index() {
		return 'I am cat index';
	}

	public function add() {
		return view('categories.add_category');
	}

	public function create() {
		return 'foo';
	}
	//https://guidelines.spatie.be/code-style/laravel-php#controllers
}
