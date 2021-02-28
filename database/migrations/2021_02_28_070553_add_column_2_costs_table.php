<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumn2CostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //
        Schema::table('costs', function (Blueprint $table) {
            $table->integer('type')->nullable()->after('value')->comment('1 = area, 2 = quantity');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('costs', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
