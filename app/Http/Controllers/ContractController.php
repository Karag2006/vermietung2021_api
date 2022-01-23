<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ContractController extends Controller
{

    public function getHighestNumber(){
        $data = Document::select('contractNumber')
            ->where('currentState', 'contract')
            ->orderBy('contractNumber', 'desc')
            ->first();

        if ($data) {
            $number = $data->contractNumber;
            return response()->json($number, Response::HTTP_OK);
        }
        $number = 465382;
        return response()->json($number, Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contractList = Document::select('id', 'contractNumber', 'collectDate', 'returnDate', 'customer_name1', 'vehicle_title', 'vehicle_plateNumber')
            ->where('currentState', 'contract')
            ->orderBy('contractNumber', 'desc')
            ->get();
        return response()->json($contractList, Response::HTTP_OK);
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

        $contract = Document::create($request->all());

        // for the Response limit the elements of the newly created Customer
        // to those that are also transfered in the Ressource List.

        $contract["selectedEquipmentList"] = json_decode($contract["selectedEquipmentList"]);
        $contract = $contract->only([
            'id',
            'contractNumber',
            'collectDate',
            'returnDate',
            'customer_name1',
            'vehicle_title',
            'vehicle_plateNumber',
            'selectedEquipmentList'
        ]);

        // Return the shortened entry of the new Customer to the Frontend,
        // so the Frontend can update its own List, with the Validated Data
        return response()->json($contract, Response::HTTP_CREATED);
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
            'contractNumber',
            'collectDate',
            'returnDate',
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
