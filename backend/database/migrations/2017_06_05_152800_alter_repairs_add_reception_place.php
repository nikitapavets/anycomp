<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Repair;

class AlterRepairsAddReceptionPlace extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('repairs', function (Blueprint $table) {
            $table->integer('reception_place_id')->unsigned();
            $table->timestamp('completed_at');
        });
        Repair::where('id', '>', '0')->update(['reception_place_id' => 1]);
        Schema::table('repairs', function (Blueprint $table) {
            $table->foreign('reception_place_id')->references('id')
                ->on('reception_places')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('repairs', function ($table) {
            $table->dropForeign('repairs_reception_place_id_foreign');
        });
        Schema::table('repairs', function ($table) {
            $table->dropColumn('reception_place_id');
        });
    }
}
