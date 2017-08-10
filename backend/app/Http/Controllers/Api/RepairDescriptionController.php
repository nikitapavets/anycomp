<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RepairDescriptionRequest;
use App\Models\Repair\RepairDescription;
use Illuminate\Http\Request;

class RepairDescriptionController extends Controller
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
        $repairDescription = RepairDescription::create($request->all());

        return response()->json($repairDescription);
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
        $repairDescription = RepairDescription::findOrFail($id);
        $repairDescription->fill($request->all())->save();

        return response()->json($repairDescription);
    }

    public function destroy($id)
    {
        $destroyedRepairDescription = RepairDescription::findOrFail($id);
        $destroyedRepairDescription->delete();

        return response()->json($destroyedRepairDescription);
    }
}
