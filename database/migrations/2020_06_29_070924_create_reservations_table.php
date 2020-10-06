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
            $table->string('confirmation_id');
            $table->unsignedInteger('account_id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('travel_agent_id')->nullable();
            $table->datetime('arrival_date');
            $table->datetime('departure_date');
            $table->datetime('actual_arrival_date')->nullable();
            $table->datetime('actual_departure_date')->nullable();
            $table->integer('nights')->nullable();
            $table->integer('adult_no')->nullable();
            $table->integer('child_no')->nullable();
            $table->string('payment_mode');
            $table->string('order_number')->nullable();
            $table->string('billing_instruction');
            $table->string('cc_type')->nullable();
            $table->string('cc_no')->nullable();
            $table->string('amount')->nullable();
            $table->string('purpose');
            $table->string('request')->nullable();
            $table->string('remarks')->nullable();
            $table->string('status')->default('TENTATIVE');
            $table->string('guarantee_type');
            $table->string('room_category_code');
            $table->string('rack_rate_code');
            $table->unsignedInteger('room_no')->nullable();
            $table->datetime('confirmed_at')->nullable();
            $table->datetime('checked_in_at')->nullable();
            $table->datetime('cancelled_at')->nullable();
            $table->datetime('checkedout_at')->nullable();
            $table->float('total_amount', 8,2)->default(0);
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
        Schema::dropIfExists('reservations');
    }
}
