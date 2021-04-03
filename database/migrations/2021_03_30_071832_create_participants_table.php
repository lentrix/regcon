<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('convention_id')->unsigned();
            $table->string('role')->default('participant');
            $table->float('amount_paid')->default(0);
            $table->string('payment_channel')->nullable();
            $table->string('accepted_by');
            $table->timestamp('nominated_at')->nullable();
            $table->string('nomination_response')->nullable();
            $table->timestamp('voted_at')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('convention_id')->references('id')->on('conventions');
            $table->unique(['user_id','convention_id']);
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
        Schema::dropIfExists('participants');
    }
}
