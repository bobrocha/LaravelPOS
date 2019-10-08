<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InventoryItems extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventory_items', function (Blueprint $table) {
			$table->bigIncrements('id')->autoIncrement()->unsigend();
			$table->timestamps();
			$table->bigInteger('category_id')->nullable()->unsigned();
			$table->text('description');
			$table->string('sku')->nullable()->unique();
			$table->decimal('price', 8, 2);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('inventory_items');
	}
}
