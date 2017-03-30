<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TvsAlterAddIsTwoTuners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('tvs', function ($table) {
		    $table->tinyInteger('is_two_tuners')->default(0);
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
		    $table->dropColumn('is_two_tuners');
	    });
    }
}
