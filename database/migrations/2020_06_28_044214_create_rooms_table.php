<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("no");
            $table->integer("floor");
            $table->string("type")->default("STANDARD");
            $table->string("status")->default("CLEAN");
            $table->string("image")->nullable();
            $table->integer("capacity")->default(1);
            $table->boolean("availability")->default(TRUE);
            $table->float('default_amount', 8, 2)->default(0);
            $table->timestamps();

            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
