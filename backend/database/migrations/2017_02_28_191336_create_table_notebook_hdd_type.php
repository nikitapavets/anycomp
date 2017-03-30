<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNotebookHddType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hdd_type_notebook', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notebook_id')->unsigned();
            $table->integer('hdd_type_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('hdd_type_notebook', function ($table) {
            $table->foreign('notebook_id')->references('id')->on('notebooks')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('hdd_type_id')->references('id')->on('hdd_types')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('notebook_hdd_type');
    }
}
