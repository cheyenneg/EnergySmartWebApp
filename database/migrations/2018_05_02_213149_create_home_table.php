<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home', function (Blueprint $table) {
            $table->integer('h_id')->autoIncrement();
            $table->string('address');
            $table->integer('u_id');
            $table->string('rent_or_own');
            $table->integer('sq_footage');
            $table->integer('inhabitants');
            $table->integer('cat_id'); //Does this need a category??
            $table->integer('years');
            $table->timestamps();
        });

        Schema::table('home', function(Blueprint $table) {
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
        Schema::dropIfExists('home');
    }
}
