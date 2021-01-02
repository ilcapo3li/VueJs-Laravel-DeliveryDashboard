<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            /////////////////////////////////////Order Details//////////////////////////
            $table->unsignedBigInteger('order_id');
			$table->unsignedBigInteger('material_type_id');
			$table->unsignedBigInteger('material_id')->nullable();
			$table->string('material')->nullable();
			$table->decimal('quantity', 7, 2);
			$table->decimal('weight', 7, 2)->nullable();
			$table->decimal('hight',  7, 2)->nullable();
			$table->decimal('width',  7, 2)->nullable();
            $table->decimal('length', 7, 2)->nullable();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('material_type_id')->references('id')->on('material_types');
			$table->foreign('material_id')->references('id')->on('materials');
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
        Schema::dropIfExists('order_items');
    }
}
