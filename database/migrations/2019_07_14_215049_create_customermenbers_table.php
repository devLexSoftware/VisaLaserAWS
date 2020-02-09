<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomermenbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customermenbers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('relationship', 250);
            $table->string('email', 50);
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
        Schema::dropIfExists('customermenbers');
    }
}
