<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_ins', function (Blueprint $table) {
            $table->id();
            $table->integer('order_number');
            $table->foreignId('provider_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->unique(['order_number','provider_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_ins');
    }
}
