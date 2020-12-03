<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCashFlowStatatementsItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_flow_statements_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->double('value')->default(0);
            $table->unsignedBigInteger('cash_flow_statement_id');
            $table->string('session_id', 300);
            $table->string('type')->default('revenue');
            $table->foreign('cash_flow_statement_id')->references('id')->on('cash_flow_statements');
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
        Schema::dropIfExists('cash_flow_statements_items');
    }
}