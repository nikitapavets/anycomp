<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AlterTvsAddProseccorCoreFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('tvs')
            ->update(['processor_core_id' => 1]);
	    Schema::table('tvs', function($table) {
		    $table->foreign('processor_core_id')->references('id')->on('processor_cores')->onDelete('restrict')->onUpdate('cascade');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('tvs', function ($table) {
		    $table->dropForeign('processor_core_id');
	    });
        DB::table('tvs')
            ->update(['processor_core_id' => 0]);
    }
}
