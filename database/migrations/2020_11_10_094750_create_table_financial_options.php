<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFinancialOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_options', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->double('value')->default(0);
            // $table->unsignedBigInteger('game_id');
            // $table->foreign('game_id')->references('id')->on('start_games');
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
        Schema::dropIfExists('financial_options');
    }
}