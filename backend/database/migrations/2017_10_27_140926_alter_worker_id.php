<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterWorkerId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('repairs', function (Blueprint $table) {
            $table->renameColumn('worker_id', 'employee_id');
        });
        Schema::table('deliveries', function (Blueprint $table) {
            $table->renameColumn('worker_id', 'employee_id');
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
            $table->renameColumn('employee_id', 'worker_id');
        });
        Schema::table('deliveries', function (Blueprint $table) {
            $table->renameColumn('employee_id', 'worker_id');
        });
    }
}
