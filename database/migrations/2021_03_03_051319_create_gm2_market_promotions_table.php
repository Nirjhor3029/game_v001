<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGm2MarketPromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gm2_market_promotions', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('market_cost_id');
            $table->foreign('market_cost_id')->references('id')->on('market_costs');

            $table->integer("promotion_id")->default(0);
            $table->integer("value")->default(0);
            $table->integer("mode")->nullable()->comment('attack = 1, defend =2');
            

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
        Schema::dropIfExists('gm2_market_promotions');
    }
}
