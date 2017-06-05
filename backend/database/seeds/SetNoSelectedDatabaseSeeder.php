<?php

use Illuminate\Database\Seeder;
use App\Models\Database\TvTuner;
use App\Models\Database\Year;
use App\Models\Database\ProcessorCore;
use App\Models\Database\CityType;
use App\Models\Database\ComputerType;
use App\Models\Database\ProcessorStage;
use App\Models\Database\Processor;
use App\Models\Database\Material;
use App\Models\Database\ScreenSurface;
use App\Models\Database\RamType;
use App\Models\Database\HddType;
use App\Models\Database\MemoryCard;
use App\Models\Database\GraphicCard;
use App\Models\Database\GraphicCardType;
use App\Models\Database\CursorControlType;
use App\Models\Database\Complect;
use App\Models\Database\StorageSize;
use App\Models\Database\City;
use App\Models\Database\ReceptionPlace;

class SetNoSelectedDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TvTuner::firstOrCreate([
            'id' => '1',
            'name' => 'No selected'
        ]);

        Year::firstOrCreate([
            'id' => '1',
            'name' => 'No selected'
        ]);

	    ProcessorCore::firstOrCreate([
            'id' => '1',
            'name' => 'No selected'
        ]);

	    CityType::firstOrCreate([
            'id' => '1',
            'name' => 'No selected'
        ]);

        ComputerType::firstOrCreate([
            'id' => '1',
            'name' => 'No selected'
        ]);

        ProcessorStage::firstOrCreate([
            'id' => '1',
            'name' => 'No selected'
        ]);

        Processor::firstOrCreate([
            'id' => '1',
            'name' => 'No selected'
        ]);

        Material::firstOrCreate([
            'id' => '1',
            'name' => 'No selected'
        ]);

        ScreenSurface::firstOrCreate([
            'id' => '1',
            'name' => 'No selected'
        ]);

        RamType::firstOrCreate([
            'id' => '1',
            'name' => 'No selected'
        ]);

        HddType::firstOrCreate([
            'id' => '1',
            'name' => 'No selected'
        ]);

        MemoryCard::firstOrCreate([
            'id' => '1',
            'name' => 'No selected'
        ]);

        GraphicCard::firstOrCreate([
            'id' => '1',
            'name' => 'No selected'
        ]);

        GraphicCardType::firstOrCreate([
            'id' => '1',
            'name' => 'No selected'
        ]);

        CursorControlType::firstOrCreate([
            'id' => '1',
            'name' => 'No selected'
        ]);

        Complect::firstOrCreate([
            'id' => '1',
            'name' => 'No selected'
        ]);

        City::firstOrCreate([
            'id' => '1',
            'name' => 'No selected'
        ]);

        StorageSize::firstOrCreate([
            'id' => '1',
            'name' => 'No selected'
        ]);

        ReceptionPlace::firstOrCreate([
            'id' => '1',
            'name' => 'No selected'
        ]);
    }
}
