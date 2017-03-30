<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToNotebooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notebooks', function ($table) {
            $table->foreign('brand_id')->references('id')
                ->on('brands')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('year_id')->references('id')
                ->on('years')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('computer_type_id')->references('id')
                ->on('computer_types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('processor_stage_id')->references('id')
                ->on('processor_stages')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('processor_id')->references('id')
                ->on('processors')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('processor_core_id')->references('id')
                ->on('processor_cores')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('screen_type_id')->references('id')
                ->on('screen_types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('screen_resolution_id')->references('id')
                ->on('screen_resolutions')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('screen_diagonal_id')->references('id')
                ->on('screen_diagonals')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('screen_surface_id')->references('id')
                ->on('screen_surfaces')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('graphic_card_id')->references('id')
                ->on('graphic_cards')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('graphic_card_type_id')->references('id')
                ->on('graphic_card_types')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('cursor_control_type_id')->references('id')
                ->on('cursor_control_types')->onDelete('restrict')->onUpdate('cascade');
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
            $table->dropForeign('brand_id_foreign');
            $table->dropForeign('year_id');
            $table->dropForeign('computer_type_id');
            $table->dropForeign('processor_stage_id');
            $table->dropForeign('processor_id');
            $table->dropForeign('processor_core_id');
            $table->dropForeign('screen_type_id');
            $table->dropForeign('screen_type_id');
            $table->dropForeign('screen_resolution_id');
            $table->dropForeign('screen_diagonal_id');
            $table->dropForeign('screen_surface_id');
            $table->dropForeign('graphic_card_id');
            $table->dropForeign('screen_diagonal_id');
            $table->dropForeign('cursor_control_type_id');
        });
    }
}
