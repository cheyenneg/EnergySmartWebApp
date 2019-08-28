<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('u_id');
            $table->string('f_name');
            $table->string('l_name');
            $table->integer('cat_id');
            $table->integer('c_id');
            $table->integer('t_id');
            $table->string('user_name');
            $table->string('email');
            $table->string('password');
            $table->string('anonymous');
            $table->string('Energy_Provider');
            $table->string('alternative');
            $table->string('alt_descr')->nullable();
            $table->string('workplace');
            $table->integer('age');
            $table->string('phone_num');
            $table->boolean('admin')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('user', function(Blueprint $table) {
            $table->foreign('cat_id')->references('cat_id')->on('category')->onDelete('cascade');
            $table->foreign('c_id')->references('c_id')->on('challenge')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
