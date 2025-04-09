<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('payment');
            $table->integer('rent_id')->unsigned();
            $table->integer('payment_method_detail_id')->unsigned();
            $table->timestamps();

            $table->foreign('rent_id')->references('id')->on('rents')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('payment_method_detail_id')->references('id')->on('payment_method_details')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_payments');
    }
}
