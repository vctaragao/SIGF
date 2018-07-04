<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('classroom_id')->unsigned();
            $table->boolean('presence');
            $table->timestamps();
        });

        Schema::table('attendences', function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('classroom_id')->references('id')->on('classrooms');
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendences');
    }
}
