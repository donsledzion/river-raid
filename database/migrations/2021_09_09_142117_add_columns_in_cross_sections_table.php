<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInCrossSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cross_sections', function (Blueprint $table) {
            $table->float('bank_r')->nullable()->after('h_scale');
            $table->float('bank_l')->nullable()->after('h_scale');
            $table->float('bottom')->nullable()->after('comparison_level');
            $table->float('water_lvl')->nullable()->after('comparison_level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cross_sections', function (Blueprint $table) {
            $table->dropColumn('bank_r');
            $table->dropColumn('bank_l');
            $table->dropColumn('water_lvl');
            $table->dropColumn('bottom');
        });
    }
}
