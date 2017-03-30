<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAdditionMenuAddColumnLink extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('catalog_addition_menus', function ($table) {
		    $table->string('link')->nullable();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('catalog_addition_menus', function ($table) {
		    $table->dropColumn('link');
	    });
    }
}
