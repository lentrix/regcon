<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNominationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nominations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('convention_id')->unsigned();
            $table->bigInteger('nominator')->unsigned();
            $table->bigInteger('nominee')->unsigned();
            $table->timestamps();

            $table->foreign('convention_id')->references('id')->on('conventions');
            $table->foreign('nominator')->references('id')->on('users');
            $table->foreign('nominee')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nominations');
    }
}
