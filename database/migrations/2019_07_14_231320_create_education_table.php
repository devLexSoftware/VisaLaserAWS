<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $table->increments('id');
            $table->string('school', 250);
            $table->string('city', 250);
            $table->string('admissionDate', 20);
            $table->string('egressDate', 20);
            $table->string('level', 250);
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
        Schema::dropIfExists('education');
    }
}
