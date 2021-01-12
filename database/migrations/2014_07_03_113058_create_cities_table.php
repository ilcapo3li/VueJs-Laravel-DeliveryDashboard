<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('cities', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('en_name');
			$table->string('ar_name');
			$table->unsignedBigInteger('country_id');
			$table->foreign('country_id')->references('id')->on('countries');
			$table->unsignedBigInteger('governorate_id');
			$table->foreign('governorate_id')->references('id')->on('governorates');
            $table->bigInteger('population')->nullable();
            $table->decimal('lat',11, 8)->nullable();
            $table->decimal('lng',11, 8)->nullable();
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
		Schema::dropIfExists('cities');
	}
}
