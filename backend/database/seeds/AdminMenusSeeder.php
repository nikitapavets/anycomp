<?php

use Illuminate\Database\Seeder;
use App\Models\AdminMenu;

class AdminMenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_menus')->delete();

        AdminMenu::create([
	        'id' => 1,
	        'img' => '#admin_repairing_service',
            'title' => 'Ремонт',
            'pos' => 1
        ]);

        AdminMenu::create([
	        'id' => 2,
	        'img' => '#admin_users',
            'title' => 'Клиенты',
            'pos' => 2
        ]);

        AdminMenu::create([
	        'id' => 3,
	        'img' => '#admin_catalog',
            'title' => 'Каталог',
            'pos' => 3
        ]);

        AdminMenu::create([
	        'id' => 4,
	        'img' => '#admin_db',
            'title' => 'База данных',
            'pos' => 4
        ]);

        AdminMenu::create([
	        'id' => 5,
	        'img' => '#shopping_cart_e0e0e0',
            'title' => 'Заказы',
            'pos' => 5
        ]);
    }
}
