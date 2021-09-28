<?php

namespace App\Http\Controllers;

use App\Models\Accessories;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accessoriesList = Accessories::select('id', 'name', 'details', 'defaultNumber')->orderBy('name')->get();
        return response()->json($accessoriesList, Response::HTTP_OK);
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

        $accessory = Accessories::create($request->all());

        $accessory = $accessory->only([
            'id',
            'name',
            'details',
            'defaultNumber',
        ]);

        return response()->json($accessory, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Accessories  $accessories
     * @return \Illuminate\Http\Response
     */
    public function show(Accessories $accessories)
    {
        $accessories = $accessories->only([
            'id',
            'name',
            'details',
            'defaultNumber',
        ]);

        return response()->json($accessories, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Accessories  $accessories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accessories $accessories)
    {
        $this->validate($request, [
            'name'                  =>  'required|string|min:5|max:50',
            'details'               =>  'nullable|string|min:10|max:600',
            'defaultNumber'         =>  'nullable|digits_between:1,2'
        ]);

        $accessories->update($request->all());

        $accessories = $accessories->only([
            'id',
            'name',
            'details',
            'defaultNumber',
        ]);

        return response()->json($accessories, Response::HTTP_OK);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Accessories  $accessories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accessories $accessories)
    {
        $id = $accessories->id;

        $accessories->delete();

        return response()->json($id, Response::HTTP_OK);
    }
}
