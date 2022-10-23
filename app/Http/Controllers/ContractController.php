<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContractRequest;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class ContractController extends Controller
{

    private function getNextNumber(){
        $number = 465382;
        $document = Document::select('contract_number')
            ->where('current_state', 'contract')
            ->orderBy('contract_number', 'desc')
            ->first();
        if($document) {
            $number = $document->contract_number + 1;
        }
        return $number;
    }

    public function getHighestNumber(){

        return response()->json($this->getNextNumber(), Response::HTTP_OK);
    }

    public function index()
    {
        $contractList = Document::with('collectAddress:id,name')
            ->select('id', 'contract_number', 'collect_date', 'return_date', 'customer_name1', 'vehicle_title', 'vehicle_plateNumber', 'collect_address_id')
            ->where('current_state', 'contract')
            ->orderBy('contract_number', 'desc')
            ->get();
        return response()->json($contractList, Response::HTTP_OK);
    }

    public function store(StoreContractRequest $request)
    {
        $token = JWTAuth::getToken();
        $username = JWTAuth::getPayload($token)->toArray()["username"];
        $user = User::where('username', $username)->first();

        $request['user_id'] = $user->id;

        $today = Carbon::today()->format('d.m.Y');
        $request['selectedEquipmentList'] = json_encode($request['selectedEquipmentList']);

        $request['contract_number'] = $this->getNextNumber();
        $request['current_state'] = "contract";
        $request['contract_date'] = $today;

        $contract = Document::create($request->all());

        $contract["selectedEquipmentList"] = json_decode($contract["selectedEquipmentList"]);
        $contract = $contract->only([
            'id',
            'contract_number',
            'collect_date',
            'return_date',
            'customer_name1',
            'vehicle_title',
            'vehicle_plateNumber',
            'selectedEquipmentList',
            'collect_address_id'
        ]);
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
    public function update(StoreContractRequest $request, $id)
    {
        $token = JWTAuth::getToken();
        $username = JWTAuth::getPayload($token)->toArray()["username"];
        $user = User::where('username', $username)->first();

        $request['user_id'] = $user->id;

        // Get Document with the id of $id
        $document = Document::where("id", $id)->first();

        $document->update($request->all());

        $document = $document->only([
            'id',
            'contract_number',
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
