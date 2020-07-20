<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('leads', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->timestamp('email_verified_at')->nullable();
			$table->string('password');
			$table->unsignedBigInteger('photo_id')->nullable();
			$table->foreign('photo_id')->references('id')->on('photos')->onDelete('set null');
			$table->integer('blocked')->default(0);
			$table->string('phonePrimary')->nullable();
			$table->timestamp('number_verified_at')->nullable();
			$table->string('PhoneSecondary')->nullable();
			$table->unsignedBigInteger('added_by')->nullable();
			$table->foreign('added_by')->references('id')->on('users')->onDelete('set null');
			$table->rememberToken();
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
		Schema::dropIfExists('leads');
	}
}