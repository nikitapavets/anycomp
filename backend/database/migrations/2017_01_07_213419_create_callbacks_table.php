<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('callbacks', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('client_name')->nullable();
	        $table->string('client_phone')->nullable();
	        $table->string('site_link')->nullable();
	        $table->string('site_referrer')->nullable();
	        $table->timestamps();
	        $table->timestamp('callback_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('callbacks');
    }
}
