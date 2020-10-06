<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reservation_id');
            $table->unsignedBigInteger('transaction_id');
            $table->integer('room_no')->nullable();
            $table->tinyInteger('is_routed')->default(0);
            $table->unsignedBigInteger('from_account_id')->nullable();
            $table->unsignedBigInteger('from_account_name')->nullable();
            $table->unsignedBigInteger('to_account_id')->nullable();
            $table->unsignedBigInteger('to_account_name')->nullable();
            $table->dateTime('routed_at')->nullable();
            $table->float('amount', 8, 2)->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            //$table->unique(['reservation_id', 'transaction_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guest_transactions');
    }
}
