<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token')->unique();
            $table->integer('field_id')->unsigned();
            $table->string('tenant_name', 50);
            $table->string('payment')->nullable();
            $table->date('date');
            $table->bigInteger('dp')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('payment_status')->default(1);
            $table->string('kode_promo')->nullable();
            $table->float('diskon')->nullable();
            $table->bigInteger('total_price');
            $table->string('reject_note')->nullable();
            $table->timestamps();

            $table->foreign('field_id')->references('id')->on('fields')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rents');
    }
}
