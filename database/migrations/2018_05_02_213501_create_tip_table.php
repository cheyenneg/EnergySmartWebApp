<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tip', function (Blueprint $table) {
            $table->integer('t_id')->autoIncrement();
            $table->string('title');
            $table->text('text');
            $table->integer('cat_id');
            $table->timestamps();
        });

        Schema::table('tip', function (Blueprint $table) {
            $table->foreign('cat_id')->references('cat_id')->on('category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tip');
    }
}
