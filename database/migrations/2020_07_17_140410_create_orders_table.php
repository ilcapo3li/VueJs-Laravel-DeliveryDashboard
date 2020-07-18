<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('orders', function (Blueprint $table) {
			$table->bigIncrements('id');
			/////////////////////////////////////Order Details//////////////////////////
			$table->unsignedBigInteger('material_type_id')->nullable();
			$table->foreign('material_type_id')->references('id')->on('material_types');
			$table->string('matrial');
			$table->decimal('wieght', 5, 2)->nullable();
			$table->decimal('hight', 5, 2)->nullable();
			$table->decimal('width', 5, 2)->nullable();
			$table->decimal('length', 5, 2)->nullable();
			///////////////////////////////Sender and Reciever/////////////////////////////
			$table->unsignedBigInteger('creator_id')->nullable();
			$table->foreign('creator_id')->references('id')->on('users');
			$table->unsignedBigInteger('lead_id')->nullable();
			$table->foreign('lead_id')->references('id')->on('leads');
			/////////////////////////////Adminstration Tracking Order///////////////////////
			$table->dateTime('collecting_at')->nullable();
			$table->unsignedBigInteger('collected_by')->nullable();
			$table->foreign('collected_by')->references('id')->on('users');
			$table->unsignedBigInteger('status_id')->nullable();
			$table->foreign('status_id')->references('id')->on('statuses');
			$table->text('note')->nullable();
			/////////////////////zone and cost else lat long calc////////////////////
			$table->unsignedBigInteger('zone_id')->nullable();
			$table->foreign('zone_id')->references('id')->on('zones');
			$table->unsignedBigInteger('price_id')->nullable();
			$table->foreign('price_id')->references('id')->on('prices');
			$table->unsignedBigInteger('home_id')->nullable();
			$table->foreign('home_id')->references('id')->on('locations');
			$table->unsignedBigInteger('away_id')->nullable();
			$table->foreign('away_id')->references('id')->on('locations');
			$table->decimal('cost', 5, 2)->nullable();
			////////////////////////////////////////////////////////

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('orders');
	}
}
