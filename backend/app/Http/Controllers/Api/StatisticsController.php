<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Repair;
use App\Repositories\RepairRepository;

class StatisticsController extends Controller
{
    public function repairs()
    {
        $statistics = RepairRepository::repairToStatistics(Repair::all());

        return response()->success($statistics);
    }
}
