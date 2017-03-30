<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TvTunerTvCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tv_tv_tuner', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('tv_tuner_id')->unsigned();
           $table->integer('tv_id')->unsigned();
           $table->timestamps();
        });

        Schema::table('tv_tv_tuner', function ($table) {
            $table->foreign('tv_tuner_id')->references('id')->on('tv_tuners')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('tv_id')->references('id')->on('tvs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tv_tuner_tv');
    }
}
