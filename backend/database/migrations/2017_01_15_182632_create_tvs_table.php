<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tvs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id')->unsigned();
            $table->integer('screen_type_id')->unsigned();
            $table->integer('screen_resolution_id')->unsigned();
            $table->integer('screen_diagonal_id')->unsigned();
            $table->string('model');
            $table->string('image')->nullable();
            $table->decimal('price', 15, 2)->default(0.00);
            $table->integer('quantity')->default(0);
	        $table->softDeletes();
            $table->timestamps();
        });

	    Schema::table('tvs', function($table) {
		    $table->foreign('brand_id')->references('id')->on('brands')->onDelete('restrict')->onUpdate('cascade');
		    $table->foreign('screen_type_id')->references('id')->on('screen_types')->onDelete('restrict')->onUpdate('cascade');
		    $table->foreign('screen_resolution_id')->references('id')->on('screen_resolutions')->onDelete('restrict')->onUpdate('cascade');
		    $table->foreign('screen_diagonal_id')->references('id')->on('screen_diagonals')->onDelete('restrict')->onUpdate('cascade');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tvs');
    }
}
