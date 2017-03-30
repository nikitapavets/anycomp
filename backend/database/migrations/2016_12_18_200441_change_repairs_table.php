<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeRepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('repairs', function ($table) {
		    $table->integer('category_id')->unsigned();
		    $table->string('defect')->nullable();
		    $table->dropColumn('diagnosis');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('repairs', function ($table) {
		    $table->dropColumn('category_id');
		    $table->dropColumn('defect');
		    $table->string('diagnosis')->nullable();
	    });
    }
}
