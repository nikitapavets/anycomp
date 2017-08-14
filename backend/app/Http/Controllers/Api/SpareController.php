<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RepairDescriptionRequest;
use App\Models\Repair;
use App\Models\Repair\RepairDescription;
use App\Models\Spare;
use App\Repositories\RepairRepository;
use App\Repositories\SpareRepository;
use Illuminate\Http\Request;

class SpareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(RepairDescriptionRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function update(RepairDescriptionRequest $request, $id)
    {

    }

    public function destroy($id)
    {

    }

    public function search(Request $request)
    {

        $result = SpareRepository::search($request->search);

        return response()->json($result);
    }

    public function bindToRepair(Request $request)
    {
        /**
         * @var Repair $repair
         */
        $repair = Repair::findOrFail($request->repair_id);
        /**
         * @var Spare $spare
         */
        $spare = Spare::findOrFail($request->spare_id);
        if($spare->hasInStock()) {
            $repair->addSpare($spare->id);
            $spare->decrementQuantity();
        }


        return response()->json($spare);
    }

    public function unbindFromRepair(Request $request)
    {
        /**
         * @var Repair $repair
         */
        $repair = Repair::findOrFail($request->repair_id);
        /**
         * @var Spare $spare
         */
        $spare = Spare::findOrFail($request->spare_id);
        $repair->removeSpare($spare->id);
        $spare->incrementQuantity();

        return response()->json($spare);
    }
}
