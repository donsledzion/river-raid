<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddComparisonLevelColumnToCrossSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cross_sections', function (Blueprint $table) {
            $table->integer('comparison_level')->default(0)->after('h_scale');
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
            $table->dropColumn('comparison_level') ;
        });
    }
}
