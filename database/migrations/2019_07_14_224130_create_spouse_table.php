<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spouse', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 250);            
            $table->string('birthday', 250);
            $table->string('birthplace', 250);
            $table->string('living', 250);            
            $table->string('divorciedDate', 20);
            $table->string('marryDate', 20);
            $table->string('description', 1000);
            $table->integer('id_procedure')->unsigned();
            $table->foreign('id_procedure')->references('id')->on('procedure');
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
        Schema::dropIfExists('spouse');
    }
}

