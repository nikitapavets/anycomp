<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRepairsAddWorkerId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $seeder = new AdminTableSeeder();
        $seeder->run();

        Schema::table('repairs', function (Blueprint $table) {
            $table->unsignedInteger('worker_id')->default(1);
        });
        Schema::table('repairs', function (Blueprint $table) {
            $table->foreign('worker_id')->references('id')
                ->on('admins')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('repairs', function (Blueprint $table) {
            $table->dropForeign(['worker_id']);
        });
        Schema::table('repairs', function (Blueprint $table) {
            $table->dropColumn('worker_id');
        });
    }
}
