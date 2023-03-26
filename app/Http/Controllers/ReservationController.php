<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocumentResource;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use App\Http\Requests\ReservationRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;

class ReservationController extends Controller
{

    private function getNextNumber()
    {
        $number = 265382;
        $document = Document::select('reservation_number')
            ->where('current_state', 'reservation')
            ->orderBy('reservation_number', 'desc')
            ->first();
        if ($document) {
            $number = $document->reservation_number + 1;
        }
        return $number;
    }

    public function getHighestNumber()
    {

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
    public function store(ReservationRequest $request)
    {
        $data = $this->useInput($request->input(), 'new');

        $reservation = Document::create($data);

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

        return new DocumentResource($document);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReservationRequest $request, $id)
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

            $output['reservation_number'] = $this->getNextNumber();
            $output['current_state'] = "reservation";
            $output['reservation_date'] = $today;
            $output['contract_bail'] = 100.0;
        }


        return $output;

    }
}
