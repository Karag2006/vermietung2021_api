<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class OfferController extends Controller
{

    public function getHighestNumber(){
        $number = Document::select('offerNumber')
            ->orderBy('offerNumber', 'desc')
            ->first();

        if ($number) {
            $number = $number->offerNumber;
            return response()->json($number, Response::HTTP_OK);
        }
        $number = 26538;
        return response()->json($number, Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offerList = Document::select('id', 'offerNumber', 'collectDate', 'returnDate', 'customer_name1', 'vehicle_title', 'vehicle_plateNumber')
            ->where('currentState', 'offer')
            ->orderBy('offerNumber', 'desc')
            ->get();
        return response()->json($offerList, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['selectedEquipmentList'] = json_encode($request['selectedEquipmentList']);

        $offer = Document::create($request->all());

        // for the Response limit the elements of the newly created Customer
        // to those that are also transfered in the Ressource List.

        $offer["selectedEquipmentList"] = json_decode($offer["selectedEquipmentList"]);
        $offer = $offer->only([
            'id',
            'offerNumber',
            'collectDate',
            'returnDate',
            'customer_name1',
            'vehicle_title',
            'vehicle_plateNumber',
            'selectedEquipmentList'
        ]);

        // Return the shortened entry of the new Customer to the Frontend,
        // so the Frontend can update its own List, with the Validated Data
        return response()->json($offer, Response::HTTP_CREATED);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
