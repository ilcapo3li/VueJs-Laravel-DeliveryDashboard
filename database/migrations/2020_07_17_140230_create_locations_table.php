<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('locations', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->mediumText('address')->nullable();
			$table->json('location')->nullable();
			$table->unsignedBigInteger('country_id');
			$table->foreign('country_id')->references('id')->on('countries');
			$table->unsignedBigInteger('governorate_id')->nullable();
			$table->foreign('governorate_id')->references('id')->on('governorates');
			$table->unsignedBigInteger('city_id');
			$table->foreign('city_id')->references('id')->on('cities');
			$table->morphs('owner');
			$table->timestamps();
            $table->softDeletes();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('locations');
	}
}
