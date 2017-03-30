<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogBasketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_baskets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('unique_user_id')->unsigned();
	        $table->integer('category_id')->unsigned();
	        $table->integer('tv_id')->unsigned();
            $table->softDeletes();
	        $table->timestamps();
        });

	    Schema::table('catalog_baskets', function($table) {
		    $table->foreign('unique_user_id')->references('id')->on('unique_users')->onDelete('cascade')->onUpdate('cascade');
		    $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('catalog_baskets');
    }
}
