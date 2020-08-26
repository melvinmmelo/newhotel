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
            $table->datetime('arrival_date');
            $table->datetime('departure_date');
            $table->datetime('actual_arrival_date')->nullable();
            $table->datetime('actual_departure_date')->nullable();
            $table->integer('adult_no')->nullable();
            $table->integer('child_no')->nullable();
            $table->string('payment_mode');
            $table->string('cc_no')->nullable();
            $table->string('cc_exp_date')->nullable();
            $table->string('ccv')->nullable();
            $table->string('cheque_bank')->nullable();
            $table->string('cheque_no')->nullable();
            $table->string('cheque_amount')->nullable();
            $table->string('purpose');
            $table->string('remarks')->nullable();
            $table->string('status')->default('TENTATIVE');
            $table->unsignedInteger('user_id');
            $table->datetime('confirmed_at')->nullable();
            $table->datetime('cancelled_at')->nullable();
            $table->datetime('checkedout_at')->nullable();
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
