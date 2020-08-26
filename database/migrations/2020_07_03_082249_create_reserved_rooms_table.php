<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservedRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserved_rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('reservation_id');
            $table->unsignedInteger('room_id');
            $table->string('rate_type');
            $table->datetime('arrival_date')->nullable();
            $table->datetime('departure_date')->nullable();
            $table->float('amount');
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
        Schema::dropIfExists('reserved_rooms');
    }
}
