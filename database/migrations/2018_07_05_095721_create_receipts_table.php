<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('client_id');
            $table->string('receipt_no');
            $table->integer('amount');
            $table->string('account')->nullable();
            $table->text('remarks')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('payment_type')->nullable();
            $table->integer('period')->nullable();
            $table->date('receipt_date')->nullable();
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
        Schema::dropIfExists('receipts');
    }
}
