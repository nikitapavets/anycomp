<?php

use Illuminate\Database\Migrations\Migration;

class AddConfigField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notebooks', function ($table) {
            $table->string('config')->nullable()->after('model');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notebooks', function ($table) {
            $table->dropColumn('config');
        });
    }
}
