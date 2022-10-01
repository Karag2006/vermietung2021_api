<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class ReservationController extends Controller
{

    private function getNextNumber(){
        $number = 265382;
        $document = Document::select('reservation_number')
            ->where('current_state', 'reservation')
            ->orderBy('reservation_number', 'desc')
            ->first();
        if($document) {
            $number = $document->reservation_number + 1;
        }
        return $number;
    }

    public function getHighestNumber(){

        return response()->json($this->getNextNumber(), Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservationList = Document::with('collectAddress:id,name')
            ->select('id', 'reservation_number', 'collect_date', 'return_date', 'customer_name1', 'vehicle_title', 'vehicle_plateNumber', 'collect_address_id')
            ->where('current_state', 'reservation')
            ->orderBy('reservation_number', 'desc')
            ->get();
        return response()->json($reservationList, Response::HTTP_OK);
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

        $request['reservation_number'] = $this->getNextNumber();
        $request['current_state'] = "reservation";
        $request['reservation_date'] = $today;

        $reservation = Document::create($request->all());

        $reservation["selectedEquipmentList"] = json_decode($reservation["selectedEquipmentList"]);
        $reservation = $reservation->only([
            'id',
            'reservation_number',
            'collect_date',
            'return_date',
            'customer_name1',
            'vehicle_title',
            'vehicle_plateNumber',
            'selectedEquipmentList'
        ]);

        // Return the shortened entry of the new Customer to the Frontend,
        // so the Frontend can update its own List, with the Validated Data
        return response()->json($reservation, Response::HTTP_CREATED);
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
            'reservation_number',
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
