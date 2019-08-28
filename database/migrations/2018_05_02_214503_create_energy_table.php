<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnergyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('energy', function (Blueprint $table) {
            $table->integer('e_id')->autoIncrement();
            $table->integer('u_id');
            $table->integer('cost');
            $table->integer('kwh');
            $table->integer('therms');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });

        Schema::table('energy', function (Blueprint $table) {
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
        Schema::dropIfExists('energy');
    }
}
