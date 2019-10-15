<?php

namespace App\Http\Controllers\Inventory\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory\Category;

class CategoriesController extends Controller
{
	public function index() {
		return 'I am cat index';
	}

	public function add() {
		return view('categories.add_category');
	}

	public function create(Request $request) {
		if($request->has('rows')) {
			$rows     = $request->input('rows');
			$category = new Category;

			foreach($rows as $row) {
				$category->firstOrCreate($row, $row);
			}
		}
	}
	
	//https://guidelines.spatie.be/code-style/laravel-php#controllers
}
