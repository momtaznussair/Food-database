<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodToxinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_toxin', function (Blueprint $table) {
          
            $table->integer('food_id');
            $table->integer('toxin_id');
            $table->primary(['food_id', 'toxin_id']);
            $table->unsignedBigInteger('rate_id');
            $table->foreign('rate_id')->references('id')->on('rates');
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
        Schema::dropIfExists('food_toxin');
    }
}
