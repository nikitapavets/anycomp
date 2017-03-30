<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminSubMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_sub_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_menu_id')->unsigned();
            $table->string('title')->nullable();
            $table->string('link')->nullable();
            $table->string('system_name')->nullable();
            $table->integer('pos')->unsigned()->default(0);
            $table->timestamps();
        });

        Schema::create('admin_sub_menus', function (Blueprint $table) {
            $table->foreign('admin_menu_id')->references('id')->on('admin_menus')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admin_sub_menus');
    }
}
