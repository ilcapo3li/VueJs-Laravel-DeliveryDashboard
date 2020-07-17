<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('permission_user',function(Blueprint $table){
        $table->bigIncrements('id');
        $table->unsignedBigInteger('user_id')->nullable();
        $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');     
        $table->unsignedBigInteger('permission_id')->nullable();
        $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('set null');     
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
        Schema::dropIfExists('permission_user');
     
    }
}
