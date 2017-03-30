<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveSizeFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notebooks', function ($table) {
            $table->dropColumn('ssd_size');
            $table->dropColumn('graphic_memory_size');
            $table->dropColumn('ram_size');
            $table->dropColumn('ram_max_size');
            $table->dropColumn('hdd_size');
            $table->integer('graphic_memory_size_id')->unsigned();
            $table->integer('ram_size_id')->unsigned();
            $table->integer('ram_max_size_id')->unsigned();
            $table->integer('hdd_size_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notebooks', function ($table) {
            $table->string('ssd_size')->nullable()->after('hdd_size');
            $table->integer('graphic_memory_size')->default(0);
            $table->integer('ram_size')->default(0);
            $table->integer('ram_max_size')->default(0);
            $table->integer('hdd_size')->unsigned();
            $table->dropColumn('graphic_memory_size_id');
            $table->dropColumn('ram_size_id');
            $table->dropColumn('ram_max_size_id');
            $table->dropColumn('hdd_size_id');
        });
    }
}
