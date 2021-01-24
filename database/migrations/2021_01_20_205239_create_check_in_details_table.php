<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckInDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_in_details', function (Blueprint $table) {
            $table->id();
            $table->integer('order_number');
            $table->integer('quantity');
            $table->foreignId('product_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('provider_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->unique(['order_number',"provider_id","product_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_in_details');
    }
}
