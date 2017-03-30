<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('admin_id')->unsigned();
            $table->string('title')->nullable();
            $table->string('code')->nullable();
            $table->string('set')->nullable();
            $table->text('diagnosis')->nullable();
            $table->integer('receipt_number')->nullable()->unsigned();
            $table->string('token')->nullable();
            $table->string('adopted_in')->nullable();
            $table->tinyInteger('status')->unsigned()->default(0);
            $table->timestamps();
        });

        Schema::table('repairs', function($table) {
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('repairs');
    }
}
