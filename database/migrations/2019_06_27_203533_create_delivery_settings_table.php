<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliverySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('price', 7, 2)->nullable();
            $table->decimal('kmCost', 7, 2)->nullable();
            $table->decimal('mQubeCost', 7, 2,)->nullable();
            $table->decimal('kgCost', 7, 2)->nullable();
            $table->decimal('retriveCost', 7, 2)->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_settings');
    }
}
