<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_descriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('repair_id');
            $table->string('value')->nullable();
            $table->decimal('price')->default(0.00);
            $table->timestamps();
        });

        Schema::table('repair_descriptions', function (Blueprint $table) {
            $table->foreign('repair_id')->references('id')
                ->on('repairs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('repair_descriptions', function ($table) {
            $table->dropForeign(['repair_id']);
        });

        Schema::drop('repair_descriptions');
    }
}
