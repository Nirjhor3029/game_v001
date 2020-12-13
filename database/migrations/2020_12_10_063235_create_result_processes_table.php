<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_processes', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('game_id');

            $table->integer("process_id");

            $table->double("assigned_value")->default(1)->nullable();
            $table->double("actual_value")->default(0)->nullable();
            $table->double("point_value")->default(0)->nullable();
            $table->double("mark_value")->default(0)->nullable();

            $table->foreign('game_id')->references('id')->on('start_games');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('result_processes');
    }
}
