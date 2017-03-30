<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TvsAlterAdd extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tvs', function ($table) {
			$table->integer('depth_with_stand')->default(0);
			$table->integer('dynamic_scenes_quality_index')->default(0);
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
			$table->dropColumn('dynamic_scenes_quality_index');
			$table->dropColumn('dynamic_scenes_quality_index');
		});
	}
}
