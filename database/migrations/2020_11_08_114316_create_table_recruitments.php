<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRecruitments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitments', function (Blueprint $table) {
            $table->id();
            $table->double('hr_manager')->default(0);
            $table->double('bdm')->default(0);
            $table->double('sales_manager')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('game_id');

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
        Schema::dropIfExists('recruitments');
    }
}