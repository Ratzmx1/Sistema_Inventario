<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckOutDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_out_details', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->foreignId('id_product')->constrained('products');
            $table->foreignId('id_check_out')->constrained('check_outs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_out_details');
    }
}
