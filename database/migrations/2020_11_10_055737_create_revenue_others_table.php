<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevenueOthersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revenue_others', function (Blueprint $table) {
            $table->id();

            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');

            // $table->unsignedBigInteger('game_id');
            // $table->foreign('game_id')->references('id')->on('start_games');
            // $table->unsignedBigInteger('market_place_id');
            // $table->foreign('market_place_id')->references('id')->on('marketplaces');

            // $table->unsignedBigInteger('product_id');
            // $table->foreign('product_id')->references('id')->on('products');

            $table->unsignedBigInteger('revenue_id');
            $table->foreign('revenue_id')->references('id')->on('revenues');

            $table->double('month1_price')->nullable();
            $table->double('month1_revenue')->nullable();
            $table->double('month2_price')->nullable();
            $table->double('month2_revenue')->nullable();

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
        Schema::dropIfExists('revenue_others');
    }
}
