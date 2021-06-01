<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaffleDrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raffle_draws', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('raffle_item_id')->unsigned();
            $table->bigInteger('participant_id')->unsigned();
            $table->timestamps();

            $table->foreign('raffle_item_id')->references('id')->on('raffle_items');
            $table->foreign('participant_id')->references('id')->on('participants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raffle_draws');
    }
}
