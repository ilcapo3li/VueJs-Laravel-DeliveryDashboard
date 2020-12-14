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
            $table->string('phonePrimary')->unique();
            $table->string('PhoneSecondary')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('website')->unique()->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
			$table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('photo_id')->nullable();
            $table->unsignedBigInteger('refered_by')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->text('token')->nullable();
            $table->integer('blocked')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('created_by')->references('id')->on('admins');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('refered_by')->references('id')->on('companies');
            $table->foreign('photo_id')->references('id')->on('attachments');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('currency_id')->references('id')->on('currencies');

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
