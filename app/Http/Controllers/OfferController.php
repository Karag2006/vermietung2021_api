<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocumentResource;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;

class OfferController extends Controller
{
    private function getNextNumber()
    {
        $number = 26538;
        $document = Document::select('offer_number')
            ->where('current_state', 'offer')
            ->orderBy('offer_number', 'desc')
            ->first();
        if ($document) {
            $number = $document->offer_number + 1;
        }
        return $number;
    }

    public function getHighestNumber()
    {


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
    public function store(OfferRequest $request)
    {
        $data = $this->useInput($request->input(), 'new');

        $offer = Document::create($data);

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

        return new DocumentResource($document);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OfferRequest $request, $id)
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

            $output['offer_number'] = $this->getNextNumber();
            $output['current_state'] = "offer";
            $output['offer_date'] = $today;
            $output['contract_bail'] = 100.0;
        }


        return $output;

    }

}
