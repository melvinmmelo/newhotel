<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('account_name')->unique();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->enum('gender', ["male", "female"]);
            $table->string('citizenship');
            $table->string('passport_id')->nullable();
            $table->date('birth_date');
            $table->float('threshold_amount', 8, 2);
            $table->enum('account_type', ['INDIVIDUAL', 'GROUP']);
            $table->string('telephone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('address_street')->nullable();
            $table->string('address_city');
            $table->string('country')->default("Philippines");
            $table->string('zip')->nullable();
            $table->string('email');
            $table->string('credit_card_type')->nullable();
            $table->string('credit_card_no');
            $table->string('credit_card_exp_date');
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
        Schema::dropIfExists('accounts');
    }
}

