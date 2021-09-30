<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipmentList = Equipment::select('id', 'name', 'details', 'defaultNumber')->orderBy('name')->get();
        return response()->json($equipmentList, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'                  =>  'required|string|min:5|max:50',
            'details'               =>  'nullable|string|min:10|max:600',
            'defaultNumber'         =>  'nullable|digits_between:1,2'
        ]);

        $equipment = Equipment::create($request->all());

        $equipment = $equipment->only([
            'id',
            'name',
            'details',
            'defaultNumber',
        ]);

        return response()->json($equipment, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment $equipment)
    {
        // $equipment = $equipment->only([
        //     'id',
        //     'name',
        //     'details',
        //     'defaultNumber'
        // ]);

        return response()->json($equipment, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipment $equipment)
    {
        $this->validate($request, [
            'name'                  =>  'required|string|min:5|max:50',
            'details'               =>  'nullable|string|min:10|max:600',
            'defaultNumber'         =>  'nullable|digits_between:1,2'
        ]);

        $equipment->update($request->all());

        $equipment = $equipment->only([
            'id',
            'name',
            'details',
            'defaultNumber',
        ]);

        return response()->json($equipment, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment)
    {
        $id = $equipment->id;

        $equipment->delete();

        return response()->json($id, Response::HTTP_OK);
    }
}
