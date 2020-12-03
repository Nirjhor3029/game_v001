<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBudgets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->double('recruitment')->default(0);
            $table->double('manufacturing')->default(0);
            $table->double('launch')->default(0);
            $table->double('other')->default(0);
            $table->unsignedBigInteger('marketplace_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('game_id');

            $table->foreign('marketplace_id')->references('id')->on('marketplaces');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('game_id')->references('id')->on('start_games');
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
        Schema::dropIfExists('budgets');
    }
}