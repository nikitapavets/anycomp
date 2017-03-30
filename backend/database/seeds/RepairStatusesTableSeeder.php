<?php

use Illuminate\Database\Seeder;
use App\Models\RepairStatus;

class RepairStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('repair_statuses')->delete();

        RepairStatus::create([
            'status' => 'Принят в ремонт',
            'rang' => 1
        ]);

        RepairStatus::create([
            'status' => 'Ожидание ремонта',
            'rang' => 1
        ]);

        RepairStatus::create([
            'status' => 'Осмотр мастером',
            'rang' => 1
        ]);

        RepairStatus::create([
            'status' => 'Диагностика',
        ]);

        RepairStatus::create([
            'status' => 'Заказ деталей',
        ]);

        RepairStatus::create([
            'status' => 'Ремонт',
        ]);

        RepairStatus::create([
            'status' => 'Заправка картриджа',
        ]);

        RepairStatus::create([
            'status' => 'Тестирование',
        ]);

        RepairStatus::create([
            'status' => 'Готов',
            'rang' => 1
        ]);

        RepairStatus::create([
            'status' => 'Выдан',
            'rang' => 1
        ]);
    }
}
