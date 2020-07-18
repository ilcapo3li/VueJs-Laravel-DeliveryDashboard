<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('prices', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('zone_id')->nullable();
			$table->foreign('zone_id')->references('id')->on('zones');
			$table->decimal('price', 5, 2)->nullable();
			$table->decimal('retrivePrice', 5, 2)->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('prices');
	}
}
