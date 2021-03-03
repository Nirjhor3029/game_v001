<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_costs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('market_id');
            $table->foreign('market_id')->references('id')->on('markets');

            $table->integer("area_type")->default(0); //cost id
            $table->integer("area_sub_type")->default(0); //cost id
            $table->integer("quality_type")->default(0); //cost id
            $table->integer("quality_sub_type")->default(0); //cost id
            
            $table->integer("area")->default(0);
            $table->integer("quality")->default(0);

            $table->integer("competitors_move")->default(0);

            

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
        Schema::dropIfExists('market_costs');
    }
}
