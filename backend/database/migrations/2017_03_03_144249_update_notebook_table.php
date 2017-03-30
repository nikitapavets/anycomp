<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateNotebookTable extends Migration
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
                $table->decimal('width', 5, 2)->default(0.00)->change();
                $table->decimal('depth', 5, 2)->default(0.00)->change();
                $table->decimal('thickness', 5, 2)->default(0.00)->change();
                $table->decimal('weight', 5, 2)->default(0.00)->change();
                $table->tinyInteger('ram_slots_count')->default(0);
                $table->tinyInteger('touch_force')->default(0);
                $table->tinyInteger('input_usb31a')->default(0);
                $table->tinyInteger('input_usb31b')->default(0);
                $table->tinyInteger('input_usb31c')->default(0);
                $table->integer('ssd_size_id')->unsigned();
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
                $table->integer('weight')->default(0)->change();
                $table->integer('depth')->default(0)->change();
                $table->integer('thickness')->default(0)->change();
                $table->integer('weight')->default(0)->change();
                $table->dropColumn('ram_slots_count');
                $table->dropColumn('touch_force');
                $table->dropColumn('input_usb31a');
                $table->dropColumn('input_usb31b');
                $table->dropColumn('input_usb31c');
                $table->dropColumn('ssd_size_id');
            }
        );
    }
}
