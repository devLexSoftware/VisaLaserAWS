<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactiondetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactiondetail', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('name', 250);            
            $table->string('description', 250);
            $table->string('price', 20);
            $table->string('quantity', 3);
            $table->string('payment', 100);
            $table->integer('id_transaction')->unsigned();
            $table->foreign('id_transaction')->references('id')->on('transaction');
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
        Schema::dropIfExists('transactiondetail');
    }
}
