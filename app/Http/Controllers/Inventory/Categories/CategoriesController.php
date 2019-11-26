<?php

namespace App\Http\Controllers\Inventory\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory\Category;

class CategoriesController extends Controller
{
	public function index() {
		return view('categories.categories');
	}

	public function add() {
		return view('categories.add_category');
	}

	public function create(Request $request, $title) {
		$category = new Category;

		if($this->categoryExists($title)) {
			return response()->json([
				'error' => 'Category already exists, please try a different one.',
			]);
		}

		$category->title = $title;

		$category->save();

		return response()->json([
			'id'    => $category->id,
			'title' => $category->title,
		]);
	}

	public function destroy(Category $category) {
		$category->delete();
	}

	public function getAll() {
		$category = new Category;

		return response()->json($category->all('id', 'title'));
	}

	public function update(Request $request, $id, $title) {
		if($this->categoryExists($title)) {
			return response()->json([
				'error' => 'Category already exists, please try a different one.',
			]);
		}
		$category        = Category::find($id);
		$category->title = $title;

		$category->save();

		return response()->json([
			'title' => $category->title,
		]);
	}

	private function categoryExists($title) {
		return Category::where('title', $title)->get()->isNotEmpty();
	}
}
