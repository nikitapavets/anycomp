<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFullTextSearch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE spares ADD FULLTEXT full(name)');
        DB::statement('ALTER TABLE brands ADD FULLTEXT full(name)');
        DB::statement('ALTER TABLE categories ADD FULLTEXT full(name)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE spares DROP INDEX full');
        DB::statement('ALTER TABLE brands DROP INDEX full');
        DB::statement('ALTER TABLE categories DROP INDEX full');
    }
}
