<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::findOrNew(1);
        $admin->id = 1;
        $admin->login = 'no_selected';
        $admin->save();
    }
}
