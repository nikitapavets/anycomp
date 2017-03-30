<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MemoryCardNotebookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memory_card_notebook', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notebook_id')->unsigned();
            $table->integer('memory_card_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('memory_card_notebook', function ($table) {
            $table->foreign('notebook_id')->references('id')->on('notebooks')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('memory_card_id')->references('id')->on('memory_cards')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('memory_card_notebook');
    }
}
