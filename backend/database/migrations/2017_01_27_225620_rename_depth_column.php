<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameDepthColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('tvs', function (Blueprint $table) {
		    $table->renameColumn('depth', 'thickness');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('tvs', function (Blueprint $table) {
		    $table->renameColumn('thickness', 'depth');
	    });
    }
}
