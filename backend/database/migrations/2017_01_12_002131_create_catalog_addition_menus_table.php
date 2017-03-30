<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogAdditionMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('catalog_addition_menus', function (Blueprint $table) {
		    $table->increments('id', true);
		    $table->integer('catalog_sub_menu_id')->unsigned();
		    $table->string('name');
		    $table->double('priority');
		    $table->timestamps();
	    });

	    Schema::table('catalog_addition_menus', function($table) {
		    $table->foreign('catalog_sub_menu_id')->references('id')->on('catalog_sub_menus')->onDelete('cascade')->onUpdate('cascade');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('catalog_addition_menus');
    }
}
