<?php

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->delete();

        Brand::create([
            'name' => 'Asus'
        ]);

        Brand::create([
            'name' => 'Acer'
        ]);

        Brand::create([
            'name' => 'Samsung'
        ]);

        Brand::create([
            'name' => 'Lenovo'
        ]);

    }
}
