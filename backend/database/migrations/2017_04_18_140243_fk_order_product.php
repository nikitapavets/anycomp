<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkOrderProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_products', function (Blueprint $table) {
            $table->integer('order_id')->unsigned();
        });
        Schema::table('order_products', function (Blueprint $table) {
            $table->foreign('order_id')->references('id')
                ->on('orders')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_products', function ($table) {
            $table->dropForeign('order_id_foreign');
        });
        Schema::table('order_products', function ($table) {
            $table->dropn('order_id');
        });
    }
}
