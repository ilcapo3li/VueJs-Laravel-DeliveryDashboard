<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZonesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('zones', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->json('location')->nullable();
			$table->unsignedBigInteger('country_id')->nullable();
			$table->foreign('country_id')->references('id')->on('countries');
			$table->unsignedBigInteger('city_id')->nullable();
			$table->foreign('city_id')->references('id')->on('cities');
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
		Schema::dropIfExists('zones');
	}
}
