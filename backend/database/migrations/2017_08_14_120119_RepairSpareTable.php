<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RepairSpareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_spare', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('repair_id');
            $table->unsignedInteger('spare_id');
            $table->timestamps();
        });

        Schema::table('repair_spare', function (Blueprint $table) {
            $table->foreign('repair_id')->references('id')->on('repairs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('spare_id')->references('id')->on('spares')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('repair_spare', function (Blueprint $table) {
            $table->dropForeign(['repair_id']);
            $table->dropForeign(['spare_id']);
        });

        Schema::drop('repair_spare');
    }
}
