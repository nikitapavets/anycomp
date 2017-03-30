<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableComplectNotebook extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complect_notebook', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notebook_id')->unsigned();
            $table->integer('complect_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('complect_notebook', function ($table) {
            $table->foreign('notebook_id')->references('id')->on('notebooks')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('complect_id')->references('id')->on('complects')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('complect_notebook');
    }
}
