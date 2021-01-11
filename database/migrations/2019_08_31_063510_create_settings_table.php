<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('gmail')->nullable();
            $table->string('facebook')->nullable();
            $table->string('whatsup')->nullable();
            $table->string('website')->nullable();
            $table->string('fbgroup')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instgram')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
