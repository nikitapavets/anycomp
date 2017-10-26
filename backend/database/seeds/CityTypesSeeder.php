<?php

use Illuminate\Database\Seeder;
use App\Models\Database\CityType;

class CityTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('city_types')->delete();

        CityType::create(
            [
                'name'       => 'Город',
                'short_name' => 'г.',
            ]
        );

        CityType::create(
            [
                'name'       => 'Деревня',
                'short_name' => 'д.',
            ]
        );

        CityType::create(
            [
                'name'       => 'Городской посёлок',
                'short_name' => 'г/п',
            ]
        );

    }
}
