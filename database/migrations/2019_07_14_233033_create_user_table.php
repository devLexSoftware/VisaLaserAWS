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
            $table->increments('id');
            $table->string('code', 20);
            $table->string('email', 50)->unique();
            $table->string('password', 50);
            $table->string('token', 100);
            $table->integer('id_userstatus')->unsigned();
            $table->foreign('id_userstatus')->references('id')->on('userstatus');
            $table->integer('id_usertype')->unsigned();
            $table->foreign('id_usertype')->references('id')->on('usertype');
            $table->integer('id_customer')->unsigned();
            $table->foreign('id_customer')->references('id')->on('customer');
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
        Schema::dropIfExists('user');
    }
}
