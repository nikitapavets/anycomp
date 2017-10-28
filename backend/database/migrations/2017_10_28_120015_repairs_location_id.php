<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RepairsLocationId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('repairs', function (Blueprint $table) {
            $table->unsignedInteger('location_id')->default(1);
        });
        Schema::table('repairs', function (Blueprint $table) {
            $table->foreign('location_id')->references('id')
                ->on('reception_places')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('repairs', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
        });
        Schema::table('repairs', function (Blueprint $table) {
            $table->dropColumn('location_id');
        });
    }
}
