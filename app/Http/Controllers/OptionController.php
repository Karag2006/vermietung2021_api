<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $optionList = Option::first()->get();
        return response()->json($optionList, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        return response()->json($option, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Option $option)
    {
        $this->validate($request, [
            'vat'                   =>  'required|integer',
            'offer_note'            =>  'nullable|string',
            'reservation_note'      =>  'nullable|string',
            'contract_note'         =>  'nullable|string',
            'document_footer'       =>  'nullable|string',
            'contactdata'           =>  'nullable|string',
        ]);

        $option->update($request->all());

        return response()->json($option, Response::HTTP_OK);
    }
}
