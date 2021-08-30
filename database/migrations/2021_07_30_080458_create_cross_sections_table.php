<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrossSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cross_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->string('name')->default('Cross Section');
            $table->float('position')->default(0);
            $table->unsignedMediumInteger('v_scale')->default(100);
            $table->unsignedMediumInteger('h_scale')->default(100);
            $table->unsignedSmallInteger('font_size')->default(32);
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
        try {
            Schema::table('cross_sections', function (Blueprint $table) {

                $table->dropForeign('profile_id');
            });
        } catch (\Exception $e){
            error_log("There was an error while trying to drop foreign key on cross_sections table:");
            error_log("Exception message: ". $e->getMessage());
        }

        Schema::dropIfExists('cross_sections');
    }
}
