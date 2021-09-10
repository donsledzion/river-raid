<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameFieldsAndDatatypesInCrossSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cross_sections', function (Blueprint $table) {
            $table->float('comparison_level')->change();
            $table->renameColumn('comparison_level','reference_level');
            $table->float('font_size')->change();
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
            $table->integer('reference_level')->change();
            $table->renameColumn('reference_level','comparison_level');
            $table->smallInteger('font_size')->change();

        });
    }
}
