<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spares', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('delivery_id');
            $table->unsignedInteger('organization_id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('brand_id');
            $table->string('name');
            $table->string('serial_number');
            $table->unsignedInteger('quantity');
            $table->decimal('price');
            $table->timestamps();
        });

        Schema::table('spares', function (Blueprint $table) {
            $table->foreign('delivery_id')->references('id')->on('deliveries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spares', function (Blueprint $table) {
            $table->dropForeign(['delivery_id']);
            $table->dropForeign(['organization_id']);
            $table->dropForeign(['category_id']);
            $table->dropForeign(['brand_id']);
        });

        Schema::drop('spares');
    }
}
