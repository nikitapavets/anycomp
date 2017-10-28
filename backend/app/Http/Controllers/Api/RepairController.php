<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Database\Location;
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

    public function setLocation(Request $request, Repair $repair)
    {
        $location = Location::findOrFail($request->location_id);
        $repair->location()->associate($location);
        $repair->save();

        return response()->json($location);
    }
}
