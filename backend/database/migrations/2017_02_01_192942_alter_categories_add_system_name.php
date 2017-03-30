<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Database\Category;

class AlterCategoriesAddSystemName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('categories', function ($table) {
		    $table->string('system_name')->nullable();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('categories', function ($table) {
		    $table->dropColumn('system_name');
	    });
    }
}
