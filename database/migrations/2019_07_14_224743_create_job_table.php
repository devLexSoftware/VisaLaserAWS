<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company', 500);            
            $table->string('address', 500);
            $table->string('ocupation', 500);
            $table->string('activities', 1000);
            $table->string('salary', 10);
            $table->string('carrer', 250);
            $table->string('description', 500);
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
        Schema::dropIfExists('job');
    }
}
