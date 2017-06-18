<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Repair;
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
}
