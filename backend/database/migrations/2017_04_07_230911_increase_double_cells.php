<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IncreaseDoubleCells extends Migration
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
                $table->decimal('width', 10, 2)->default(0.00)->change();
                $table->decimal('depth', 10, 2)->default(0.00)->change();
                $table->decimal('thickness', 10, 2)->default(0.00)->change();
                $table->decimal('weight', 10, 2)->default(0.00)->change();
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
                $table->decimal('width', 5, 2)->default(0.00)->change();
                $table->decimal('depth', 5, 2)->default(0.00)->change();
                $table->decimal('thickness', 5, 2)->default(0.00)->change();
                $table->decimal('weight', 5, 2)->default(0.00)->change();
            }
        );
    }
}
