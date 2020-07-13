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
            $table->string("type")->default("single");
            $table->string("status")->default("clean");
            $table->string("image")->nullable();
            $table->integer("capacity")->default(1);
            $table->boolean("availabity")->default(FALSE);
            $table->float('default_amount', 8, 2);
            $table->unsignedBigInteger("user_id");
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
        Schema::dropIfExists('rooms');
    }
}
