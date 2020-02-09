<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIrregularityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('irregularity', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tentativeDate', 20);
            $table->string('durationTravel', 250);
            $table->string('expeditionDate', 20);
            $table->string('expeditionAproxDate', 50);
            $table->string('expirationDate', 20);            
            $table->string('denyDate', 20);     
            $table->string('denyDescription', 1000);     
            $table->string('stolenDate', 20);     
            $table->string('stolenDescription', 255);     
            $table->string('countriesTravel', 500);     
            $table->string('languages', 500);     
            $table->string('descriptionArrested', 1000);     
            $table->string('descriptionCancelled', 1000);     
            $table->string('descriptionDisease', 1000);     
            $table->string('descriptionTraining', 1000);     
            $table->string('descriptionOrganizedCrime', 1000);     
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
        Schema::dropIfExists('irregularity');
    }
}
