<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSsdSize extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notebooks', function ($table) {
            $table->string('ssd_size')->nullable()->after('hdd_size');
            $table->string('graphic_card_model')->nullable()->after('graphic_card_type_id');
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
            $table->dropColumn('ssd_size');
            $table->dropColumn('graphic_card_model');
        });
    }
}
