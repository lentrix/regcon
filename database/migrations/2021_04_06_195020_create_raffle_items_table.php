<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaffleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raffle_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('convention_id')->unsigned();
            $table->string('itemName');
            $table->string('sponsor');
            $table->integer('qty');
            $table->timestamps();

            $table->foreign('convention_id')->references('id')->on('conventions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raffle_items');
    }
}
