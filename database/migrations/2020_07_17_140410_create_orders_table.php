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
			$table->string('code');
			
			///////////////////////////////Sender and Reciever/////////////////////////////
            $table->morphs('sender');
            $table->morphs('receiver');
			/////////////////////////////Adminstration Tracking Order///////////////////////
			$table->unsignedBigInteger('company_id');
			$table->dateTime('collecting_at')->nullable();
			$table->unsignedBigInteger('representative_id')->nullable();
			$table->unsignedBigInteger('statue_id')->nullable();
			$table->text('note')->nullable();
			/////////////////////zone and cost else lat long calc////////////////////
			$table->unsignedBigInteger('zone_id')->nullable();
			$table->unsignedBigInteger('home_id')->nullable();
			$table->unsignedBigInteger('away_id')->nullable();
			$table->decimal('cost', 9, 2)->nullable();
			$table->tinyInteger('payed')->default(1);
			////////////////////////////////////////////////////////
			$table->timestamps();
            $table->softDeletes();
			////////////////////////////////////////////////////////
			$table->foreign('company_id')->references('id')->on('companies');
			$table->foreign('representative_id')->references('id')->on('representatives');
			$table->foreign('statue_id')->references('id')->on('status');
			$table->foreign('zone_id')->references('id')->on('zones');
			$table->foreign('home_id')->references('id')->on('locations');
			$table->foreign('away_id')->references('id')->on('locations');
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
