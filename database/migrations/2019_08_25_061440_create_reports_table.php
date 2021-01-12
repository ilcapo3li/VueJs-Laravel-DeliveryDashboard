<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('creator');
            $table->morphs('owner');
            $table->string('title');
            $table->longText('message');
            $table->dateTime('collecting_at')->nullable();
            $table->unsignedBigInteger('collected_by')->nullable();
            $table->foreign('collected_by')->references('id')->on('users');
            $table->enum('status', ['solved', 'open', 'closed'])->nullable();
            $table->bigInteger('rank')->default(0);
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
        Schema::dropIfExists('reports');
    }
}
