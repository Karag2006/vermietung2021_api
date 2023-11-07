<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocumentResource;
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

    private function getNextNumber()
    {
        $number = 465382;
        $document = Document::select('contract_number')
            ->where('current_state', 'contract')
            ->orderBy('contract_number', 'desc')
            ->first();
        if ($document) {
            $number = $document->contract_number + 1;
        }
        return $number;
    }

    public function getHighestNumber()
    {

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
        $data = $this->useInput($request->input(), 'new');

        $contract = Document::create($data);

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

        return new DocumentResource($document);
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
        // $token = JWTAuth::getToken();
        // $username = JWTAuth::getPayload($token)->toArray()["username"];
        // $user = User::where('username', $username)->first();

        // $request['user_id'] = $user->id;

        $data = $this->useInput($request->input(), 'update');

        // Get Document with the id of $id
        $document = Document::where("id", $id)->first();

        $document->update($data);

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

    private function useInput($input, $mode)
    {
        $output = [];
        $customer = $input['customer'];
        $driver = $input['driver'];
        $trailer = $input['trailer'];
        $data = $input['data'];
        $settings = $input['settings'];

        foreach ($customer as $key => $value) {
            $output['customer_' . $key] = $value;
        }
        foreach ($driver as $key => $value) {
            $output['driver_' . $key] = $value;
        }
        foreach ($trailer as $key => $value) {
            $output['vehicle_' . $key] = $value;
        }
        foreach ($data as $key => $value) {
            $output[$key] = $value;
        }
        foreach ($settings as $key => $value) {
            $output[$key] = $value;
        }

        if ($mode == 'new') {
            $token = JWTAuth::getToken();
            $username = JWTAuth::getPayload($token)->toArray()["username"];
            $user = User::where('username', $username)->first();

            $output['user_id'] = $user->id;

            $today = Carbon::today()->format('d.m.Y');
            $output['selectedEquipmentList'] = json_encode($output['selectedEquipmentList']);

            $output['contract_number'] = $this->getNextNumber();
            $output['current_state'] = "contract";
            $output['contract_date'] = $today;
            // $output['contract_bail'] = 100.0;
        }


        return $output;

    }
}
