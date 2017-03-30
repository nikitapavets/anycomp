<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTvsTableChangeProductWeight extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('tvs', function ($table) {
		    $table->float('weight', 3, 2)->default(0.00)->change();
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
		    $table->integer('weight')->default(0)->change();
	    });
    }
}
