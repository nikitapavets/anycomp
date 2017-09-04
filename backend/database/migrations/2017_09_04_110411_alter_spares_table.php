<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSparesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('spares', function (Blueprint $table) {
            $table->string('owner_number')->nullable()->after('serial_number');
            $table->string('config')->nullable()->after('serial_number');
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
            $table->dropColumn([
                'owner_number',
                'config',
            ]);
        });
    }
}
