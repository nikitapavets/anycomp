<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Repair;
use App\Models\Worker;
use App\Repositories\RepairRepository;
use Illuminate\Http\Request;

class RepairController extends Controller
{
    public function index(Request $request)
    {
        $repairs = RepairRepository::repairsToArray(
            RepairRepository::getRepairs($request->input('size'), $request->input('orderBy'))
        );

        return response()->json($repairs);
    }

    public function updateStatus(Request $request)
    {
        $repair = Repair::find($request->repairId);
        $repair->setStatus($request->statusId);
        $repair->save();

        return response()->json($request->statusId);
    }

    public function setWorker(Request $request, Repair $repair)
    {
        $worker = Worker::find($request->worker_id);
        if($worker) {
            $repair->worker()->associate($worker);
        } else {
            $repair->worker_id = Worker::NO_SELECTED_ID;
        }
        $repair->save();

        return response()->json($worker);
    }
}
