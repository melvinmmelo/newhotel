<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->enum("accounting_side", ["DEBIT", "CREDIT"])->default("DEBIT");
            $table->string("memo");
            $table->integer("local_tax")->default(0);
            $table->tinyInteger("local_tax_inclusive")->default(0);
            $table->float("warning_amount")->default(0);
            $table->float("default_amount")->default(0);
            $table->string("default_source_doc")->default('auto');
            $table->integer("govt_tax")->default(12);
            $table->tinyInteger("govt_tax_inclusive");
            $table->integer("service_charge");
            $table->tinyInteger("service_charge_inclusive");
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
        Schema::dropIfExists('transactions');
    }
}
