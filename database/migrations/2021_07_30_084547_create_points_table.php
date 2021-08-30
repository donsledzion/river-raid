<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cross_section_id');
            $table->foreign('cross_section_id')->references('id')->on('cross_sections');
            $table->float('x');
            $table->float('y');
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
            Schema::table('points', function (Blueprint $table) {

                $table->dropForeign('cross_section_id');
            });
        } catch (\Exception $e){
            error_log("There was an error while trying to drop foreign key on points table:");
            error_log("Exception message: ". $e->getMessage());
        }

        Schema::dropIfExists('points');
    }
}
