<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client_id');
            $table->integer('amount');
            $table->string('loan_id');
            $table->decimal('interest_rate')->nullable();
            $table->integer('repayment_period')->nullable();
            $table->decimal('balance')->nullable();
            $table->integer('repayed')->nullable();
            $table->string('loan_type')->nullable();
            $table->date('application_date');
            $table->date('disburse_date')->nullable();
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
        Schema::dropIfExists('loans');
    }
}
