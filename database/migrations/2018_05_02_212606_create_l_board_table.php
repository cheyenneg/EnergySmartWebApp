<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLBoardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_board', function (Blueprint $table) {
            $table->integer('l_id')->autoIncrement();
            $table->integer('score');
            $table->integer('u_id');
            //$table->foreign('u_id')->references('u_id')->on('user')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('l_board', function (Blueprint $table) {
            $table->foreign('u_id')->references('u_id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('l_board');
    }
}
