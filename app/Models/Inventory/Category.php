<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	/**
	 * The table the model belongs to
	 *
	 * @var string
	 */
	protected $table    = 'inventory_categories';

	/**
	 * The table attributes that are mass assignalbe
	 *
	 * @var array
	 */
	protected $fillable = ['title'];
}
