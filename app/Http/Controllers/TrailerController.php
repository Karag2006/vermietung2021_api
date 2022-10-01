<?php

namespace App\Http\Controllers;

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
        $trailerList = trailer::select('id', 'title', 'plateNumber', 'totalWeight', 'loadingSize', 'tuev')->orderBy('plateNumber')->get();
        return response()->json($trailerList, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the Input
        $this->validate($request, [
            'title'                 =>  'nullable|string|min:8|max:50',
            'plateNumber'           =>  'required|string|max:13',
            'chassisNumber'         =>  'nullable|string|max:50',
            'totalWeight'           =>  'nullable|string|min:3|max:4',
            'usableWeight'          =>  'nullable|string|min:3|max:4',
            'loadingSize'           =>  'nullable|string|min:7|max:20',
            'tuev'                  =>  'nullable',
            'comment'               =>  'nullable|string|max:1000'
        ]);

        $trailer = trailer::create($request->all());

        // for the Response limit the elements of the newly created trailer
        // to those that are also transfered in the Ressource List.
        $trailer = $trailer->only([
            'id',
            'title',
            'plateNumber',
            'totalWeight',
            'loadingSize',
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
            'loadingSize',
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
    public function update(Request $request, trailer $trailer)
    {
        // Validate the Input
        $this->validate($request, [
            'title'                 =>  'nullable|string|min:8|max:50',
            'plateNumber'           =>  'required|string|max:13',
            'chassisNumber'         =>  'nullable|string|max:50',
            'totalWeight'           =>  'nullable|string|min:3|max:4',
            'usableWeight'          =>  'nullable|string|min:3|max:4',
            'loadingSize'           =>  'nullable|string|min:7|max:20',
            'tuev'                  =>  'nullable',
            'comment'               =>  'nullable|string|max:1000'
        ]);

        $trailer->update($request->all());

        // for the Response limit the elements of the newly created trailer
        // to those that are also transfered in the Ressource List.
        $trailer = $trailer->only([
            'id',
            'title',
            'plateNumber',
            'totalWeight',
            'loadingSize',
            'tuev'
        ]);

        // Return the shortened entry of the new trailer to the Frontend,
        // so the Frontend can update its own List, with the Validated Data
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
