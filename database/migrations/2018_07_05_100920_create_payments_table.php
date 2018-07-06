<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('payment_no');
            $table->string('client_id');
            $table->string('period')->nullable();
            $table->string('account')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('amount')->nullable();
            $table->text('remarks')->nullable();
            $table->text('payment_date')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('payments');
    }
}
