<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsPopularNotebooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'notebooks',
            function ($table) {
                $table->tinyInteger('is_popular')->default(0);
            }
        );
        Schema::table(
            'tvs',
            function ($table) {
                $table->tinyInteger('is_popular')->default(0);
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'notebooks',
            function ($table) {
                $table->dropColumn('is_popular');
            }
        );
        Schema::table(
            'tvs',
            function ($table) {
                $table->dropColumn('is_popular');
            }
        );
    }
}
