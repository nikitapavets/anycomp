<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRepairsAddIssuedAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('repairs', function (Blueprint $table) {
            $table->renameColumn('completed_at', 'issued_at')->nullable();
        });
        Schema::table('repairs', function (Blueprint $table) {
            $table->timestamp('completed_at');
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
            $table->dropColumn('completed_at');
        });
        Schema::table('repairs', function (Blueprint $table) {
            $table->renameColumn('issued_at', 'completed_at');
        });
    }
}
