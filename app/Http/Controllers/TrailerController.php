<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrailerRequest;
use App\Models\trailer;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrailerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trailerList = trailer::select('id', 'title', 'plateNumber', 'totalWeight', 'loading_size', 'tuev')->orderBy('plateNumber')->get();
        return response()->json($trailerList, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrailerRequest $request)
    {
        $trailer = trailer::create($request->all());

        $trailer = $trailer->only([
            'id',
            'title',
            'plateNumber',
            'totalWeight',
            'loading_size',
            'tuev'
        ]);

        // Return the shortened entry of the new trailer to the Frontend,
        // so the Frontend can update its own List, with the Validated Data
        return response()->json($trailer, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\trailer  $trailer
     * @return \Illuminate\Http\Response
     */
    public function show(trailer $trailer)
    {
        $trailer = $trailer->only([
            'id',
            'title',
            'plateNumber',
            'chassisNumber',
            'totalWeight',
            'usableWeight',
            'loading_size',
            'tuev',
            'comment'
        ]);

        return response()->json($trailer, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\trailer  $trailer
     * @return \Illuminate\Http\Response
     */
    public function update(TrailerRequest $request, trailer $trailer)
    {

        $trailer->update($request->all());

        $trailer = $trailer->only([
            'id',
            'title',
            'plateNumber',
            'totalWeight',
            'loading_size',
            'tuev'
        ]);
        return response()->json($trailer, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\trailer  $trailer
     * @return \Illuminate\Http\Response
     */
    public function destroy(trailer $trailer)
    {
        // Save the ID of the trailer to be deleted
        $id = $trailer->id;

        $trailer->delete();

        // include the id in the Response, so the Frontend can update its list.
        return response()->json($id, Response::HTTP_OK);
    }

    public function getTuev(trailer $trailer)
    {
        $trailer = $trailer->only([
            'id',
            'tuev',
        ]);

        return response()->json($trailer, Response::HTTP_OK);
    }
}
