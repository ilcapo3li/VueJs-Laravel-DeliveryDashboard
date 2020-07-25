<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('en_name');
            $table->string('ar_name');
            $table->text('address')->nullable();
            $table->json('location')->nullable();    
            $table->string('phonePrimary');
            $table->string('PhoneSecondary')->nullable();
            $table->string('email')->unique();
            $table->string('website')->unique()->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries');
			$table->unsignedBigInteger('city_id')->nullable();
			$table->foreign('city_id')->references('id')->on('cities');
            $table->unsignedBigInteger('photo_id')->nullable();
            $table->foreign('photo_id')->references('id')->on('photos');
            $table->unsignedBigInteger('refered_by')->nullable();
            $table->foreign('refered_by')->references('id')->on('companies');
            $table->integer('created_by')->nullable();
            $table->text('token')->nullable();
            $table->integer('blocked')->default(0);

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
        Schema::dropIfExists('companies');
    }
}
