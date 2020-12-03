<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revenues', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('game_id');
            $table->foreign('game_id')->references('id')->on('start_games');
            $table->unsignedBigInteger('market_place_id');
            $table->foreign('market_place_id')->references('id')->on('marketplaces');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            
            $table->double('product_cost')->nullable();
            $table->double('opex')->nullable();
            $table->double('total_cost')->nullable();
            $table->double('competitors_price')->nullable();
            $table->double('mark_up')->nullable();
            $table->double('price')->nullable();
            $table->double('unit_sold')->nullable();
            $table->double('revenue')->nullable();



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
        Schema::dropIfExists('revenues');
    }
}
