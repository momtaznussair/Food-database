<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDietFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diet_food', function (Blueprint $table) {
            
            $table->integer('diet_id');
            $table->integer('food_id');
            $table->primary(['diet_id', 'food_id']);
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
        Schema::dropIfExists('diet_food');
    }
}
