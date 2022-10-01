<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class OfferController extends Controller
{
    private function getNextNumber(){
        $number = 26538;
        $document = Document::select('offer_number')
            ->where('current_state', 'offer')
            ->orderBy('offer_number', 'desc')
            ->first();
        if($document) {
            $number = $document->offer_number + 1;
        }
        return $number;
    }

    public function getHighestNumber(){


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offerList = Document::with('collectAddress:id,name')
            ->select('id', 'offer_number', 'collect_date', 'return_date', 'customer_name1', 'vehicle_title', 'vehicle_plateNumber', 'collect_address_id')
            ->where('current_state', 'offer')
            ->orderBy('offer_number', 'desc')
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
        $today = Carbon::today()->format('d.m.Y');
        $request['selectedEquipmentList'] = json_encode($request['selectedEquipmentList']);

        $request['offer_number'] = $this->getNextNumber();
        $request['current_state'] = "offer";
        $request['offer_date'] = $today;

        $offer = Document::create($request->all());

        // for the Response limit the elements of the newly created Customer
        // to those that are also transfered in the Ressource List.

        $offer["selectedEquipmentList"] = json_decode($offer["selectedEquipmentList"]);
        $offer = $offer->only([
            'id',
            'offer_number',
            'collect_date',
            'return_date',
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
        // Get Document with the id of $id
        $document = Document::where("id", $id)->first();

        $document["selectedEquipmentList"] = json_decode($document["selectedEquipmentList"]);

        return response()->json($document, Response::HTTP_OK);
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
        // Validate Input

        // Get Document with the id of $id
        $document = Document::where("id", $id)->first();

        $document->update($request->all());

        $document = $document->only([
            'id',
            'offer_number',
            'collect_date',
            'return_date',
            'customer_name1',
            'vehicle_title',
            'vehicle_plateNumber',
            'selectedEquipmentList'
        ]);

        return response()->json(
            $document,
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get Document with the id of $id
        $document = Document::where("id", $id)->first();

        // Delete the selected Document
        $document->delete();

        // include the id in the Response, so the Frontend can update its list.
        return response()->json($id, Response::HTTP_OK);
    }


}
