<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedure', function (Blueprint $table) {
            $table->increments('id');
            $table->string('birthplace', 250);            
            $table->string('civilStatus', 50);
            $table->string('homephone', 20);
            $table->string('address', 250);
            $table->string('visaType', 100);
            $table->string('passport', 100);
            $table->string('passportCity', 100);
            $table->string('passportExpedition', 100);
            $table->string('passportExpiration', 100);
            $table->integer('id_customer')->unsigned();
            $table->foreign('id_customer')->references('id')->on('customer');
            $table->integer('id_procedurestatus')->unsigned();
            $table->foreign('id_procedurestatus')->references('id')->on('procedurestatus');
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
        Schema::dropIfExists('procedure');
    }
}

