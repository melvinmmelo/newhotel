<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('account_id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('travel_agent_id')->nullable();
            $table->datetime('arrival_date')->nullable();
            $table->datetime('departure_date')->nullable();
            $table->datetime('actual_arrival_date')->nullable();
            $table->datetime('actual_departure_date')->nullable();
            $table->integer('adult_no')->nullable();
            $table->integer('child_no')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('purpose')->nullable();
            $table->string('market_segment')->nullable();
            $table->string('remarks')->nullable();
            $table->string('status')->default('reserved');
            $table->unsignedInteger('user_id');
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
        Schema::dropIfExists('reservations');
    }
}
