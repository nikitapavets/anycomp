<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCardsCell extends Migration
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
                $table->tinyInteger('is_memory_cards')->default(0);
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
                $table->dropColumn('is_memory_cards');
            }
        );
    }
}
