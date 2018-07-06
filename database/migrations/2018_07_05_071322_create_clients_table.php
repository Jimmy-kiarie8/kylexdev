<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('client_id')->nullable();
            $table->string('name');
            $table->string('pin')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('location')->nullable();
            $table->string('id_no')->nullable();
            $table->string('address')->nullable();
            $table->boolean('active')->default(false);
            $table->boolean('employed')->default(false);
            $table->string('monthly_salary')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('status')->nullable();
            $table->string('profile')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
