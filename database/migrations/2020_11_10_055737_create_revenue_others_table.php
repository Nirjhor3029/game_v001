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


            $table->unsignedBigInteger('revenue_id');
            $table->foreign('revenue_id')->references('id')->on('revenues');

            $table->double('month1_unit')->nullable();
            $table->double('month1_revenue')->nullable();
            $table->double('month2_unit')->nullable();
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
