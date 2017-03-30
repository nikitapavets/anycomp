<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function ($table) {
            $table->integer('city_id')->unsigned()->default(1);
        });
        Schema::table('clients', function ($table) {
            $table->foreign('city_id')->references('id')
                ->on('cities')->onDelete('restrict')->onUpdate('cascade');
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
            $table->dropForeign('clients_city_id_foreign');
        });
        Schema::table('clients', function ($table) {
            $table->dropColumn('city_id');
        });
    }
}
