<?php

namespace App\Http\Controllers;

use App\Models\CollectAddress;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CollectAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collectAddressList = CollectAddress::select('id', 'name', 'address')->orderBy('name')->get();
        return response()->json($collectAddressList, Response::HTTP_OK);
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
            'name'                  =>  'required|string|min:3|max:30',
            'address'               =>  'required|string|max:100',
        ]);

        $address = CollectAddress::create($request->all());

        $address = $address->only([
            'id',
            'name',
            'address'
        ]);

        return response()->json($address, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CollectAddress  $collectAddress
     * @return \Illuminate\Http\Response
     */
    public function show(CollectAddress $collectAddress)
    {
        $collectAddress = $collectAddress->only([
            'id',
            'name',
            'address'
        ]);
        return response()->json($collectAddress, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CollectAddress  $collectAddress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CollectAddress $collectAddress)
    {
        $this->validate($request, [
            'name'                  =>  'required|string|min:3|max:30',
            'address'               =>  'required|string|max:100',
        ]);

        $collectAddress->update($request->all());

        $collectAddress = $collectAddress->only([
            'id',
            'name',
            'address'
        ]);

        return response()->json($collectAddress, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CollectAddress  $collectAddress
     * @return \Illuminate\Http\Response
     */
    public function destroy(CollectAddress $collectAddress)
    {
        $id = $collectAddress->id;

        $collectAddress->delete();

        // include the id in the Response, so the Frontend can update its list.
        return response()->json($id, Response::HTTP_OK);
    }
}
