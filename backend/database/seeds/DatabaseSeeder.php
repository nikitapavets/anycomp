<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(RepairStatusesTableSeeder::class);
//        $this->call(CategoryTableSeeder::class);
//        $this->call(AdminMenusSeeder::class);
//        $this->call(AdminSubMenuSeeder::class);
//        $this->call(BrandsTableSeeder::class);
//         $this->call(CityTypesSeeder::class);
//        $this->call(SetNoSelectedDatabaseSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
