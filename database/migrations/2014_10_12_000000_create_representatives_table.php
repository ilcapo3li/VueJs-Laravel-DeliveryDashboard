<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepresentativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representatives', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phonePrimary')->unique();
            $table->string('PhoneSecondary')->unique()->nullable();
            $table->unsignedBigInteger('photo_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->tinyInteger('disabled')->default(0);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('number_verified_at')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('photo_id')->references('id')->on('attachments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('representatives');
    }
}
