<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\RepairRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class StatisticsController extends Controller
{
    public function repairs()
    {
        $statistics = RepairRepository::repairToStatistics(RepairRepository::getRepairs());
        return response()->json($statistics);
    }
}
