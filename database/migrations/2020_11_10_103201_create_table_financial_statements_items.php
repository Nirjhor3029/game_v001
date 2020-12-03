<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFinancialStatementsItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_statement_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->double('value')->default(0);
            $table->unsignedBigInteger('financial_id');
            $table->string('session_id', 300);
            $table->string('type')->default('revenue');
            $table->foreign('financial_id')->references('id')->on('financial_statements');
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
        Schema::dropIfExists('financial_statement_items');
    }
}