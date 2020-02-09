<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nameMother', 250);
            $table->string('statusMigratoryMother', 250);
            $table->string('birthdayMother', 20);
            $table->string('nameFather', 250);
            $table->string('statusMigratoryFather', 250);
            $table->string('birthdayFather', 20);
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
        Schema::dropIfExists('parent');
    }
}
