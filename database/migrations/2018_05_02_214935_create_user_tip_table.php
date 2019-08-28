<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tip', function (Blueprint $table) {
            $table->integer('u_id');
            $table->integer('t_id');
            $table->primary(['u_id', 't_id']);
            $table->timestamps();
        });

        Schema::table('user_tip', function (Blueprint $table) {
            $table->foreign('u_id')->references('u_id')->on('user')->onDelete('cascade');
            $table->foreign('t_id')->references('t_id')->on('tip')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_tip');
    }
}
