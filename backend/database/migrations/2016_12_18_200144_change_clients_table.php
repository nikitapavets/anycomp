<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('clients', function ($table) {
		    $table->string('address_city')->nullable();
		    $table->string('address_street')->nullable();
		    $table->string('address_house', 11)->nulable();
		    $table->integer('address_flat')->unsigned();
		    $table->dropColumn('address');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('clients', function ($table) {
		    $table->dropColumn('address_city');
		    $table->dropColumn('address_street');
		    $table->dropColumn('address_house');
		    $table->dropColumn('address_flat');
		    $table->string('address')->nullable();
	    });
    }
}
