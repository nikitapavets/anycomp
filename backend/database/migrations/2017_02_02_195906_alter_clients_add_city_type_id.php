<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterClientsAddCityTypeId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function ($table) {
            $table->integer('city_type_id')->unsigned();
        });
        DB::table('clients')
            ->update(['city_type_id' => 1]);
        Schema::table('clients', function($table) {
            $table->foreign('city_type_id')->references('id')->on('city_types')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function ($table) {
            $table->dropForeign('clients_city_type_id_foreign');
        });
        Schema::table('clients', function ($table) {
            $table->dropColumn('city_type_id')->unsigned();
        });
    }
}
