<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class DocumentController extends Controller
{
    private function getNextNumber($type, $default){
        $propertyName = $type."_number";
        $document = Document::select($propertyName)
            ->orderByRaw("CASE WHEN ".$propertyName." IS NULL THEN 0 ELSE 1 END DESC")
            ->orderBy($propertyName, 'desc')
            ->first();
        if($document) {
            return max(($document->{$propertyName} + 1), $default);
        }
        return $default;
    }

    private function getISODate($value){
        return $value ? Carbon::createFromFormat(config('custom.date_format'), $value)->format('Y-m-d') : null;
    }

    private function getGermanDate($value){
        return $value ? Carbon::parse($value)->format(config('custom.date_format')) : null;
    }

    private function translateDocumentType($type){
        if ($type === 'offer') return "Angebot";
        if ($type === 'reservation') return "Reservierung";
        if ($type === 'contract') return "Mietvertrag";
        return null;
    }

    public function forwardDocument(Request $request, $id){
        $document = Document::where("id", $id)->first();

        $currentDate = Carbon::today()->format('d.m.Y');
        $nextDocumentType = "";
        if ($document->current_state == 'offer') {
            $nextDocumentType = 'reservation';
            $nextDocumentDefaultNumber = 1;
        }
        else {
            $nextDocumentType = 'contract';
            $nextDocumentDefaultNumber = 1;
        }

        // TODO: Create option to define a default Value for each Document Number in the options Table.

        $newNumber = $this->getNextNumber($nextDocumentType, $nextDocumentDefaultNumber);

        $request[$nextDocumentType.'_number'] = $newNumber;
        $request[$nextDocumentType.'_date'] = $currentDate;
        $request['current_state'] = $nextDocumentType;
        $document->update($request->all());

        $document = $document->only([
            'id',
            'reservation_number',
            'contract_number',
            'current_state',
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


    public function collisionCheck(Request $request) {

        if (!$request['vehicle_id'] ||
            !$request['collect_date'] ||
            !$request['return_date'] ||
            !$request['collect_time'] ||
            !$request['return_time']
        )
        return response()->json(null, Response::HTTP_UNPROCESSABLE_ENTITY);

        $collectDate = $this->getISODate($request['collect_date']);
        $returnDate = $this->getISODate($request['return_date']);
        $currentDate = Carbon::today()->format('Y-m-d');

        $collisionDocument = Document::whereNot('id', $request['id'])
            ->whereNot('return_date', '<', $currentDate)
            ->where('vehicle_id', $request['vehicle_id'])
            ->where(function ($query) use($collectDate, $returnDate){
                $query->where('collect_date', '<=', $returnDate)
                ->where('return_date', '>=', $collectDate);
            })->first();

        if(!$collisionDocument) return response()->json(['collision' => 'no'], Response::HTTP_OK);

        $data = [
            'collision' => 'yes',
            'collisionData' => [
                'documentType' => $this->translateDocumentType($collisionDocument['current_state']),
                'documentNumber' => $collisionDocument[$collisionDocument['current_state'].'_number'],
                'startDate' => $collisionDocument['collect_date'],
                'endDate' => $collisionDocument['return_date'],
                'startTime' => $collisionDocument['collect_time'],
                'endTime' => $collisionDocument['return_time'],
                'customerName' => $collisionDocument['customer_name1'],
                'reservationFeePayed' => $collisionDocument['reservation_deposit_recieved'],
                'reservationFeeDate' => $collisionDocument['reservation_deposit_date']
            ]
        ];
        return response()->json($data, Response::HTTP_OK);
    }


    public function downloadPDF($id)
    {
        $document = Document::where("id", $id)->first();

        if ($document->current_state == 'offer') {
            $DEtype = "Angebot";
            $number = $document->offer_number;
            $documentDate = $document->offer_date;
            $note = $document->offer_note;
            $user = $document->user->name;
        }
        if ($document->current_state == 'reservation') {
            $DEtype = "Reservierung";
            $number = $document->reservation_number;
            $documentDate = $document->reservation_date;
            $note = $document->reservation_note;
            $user = $document->user->name;
        }
        if ($document->current_state == 'contract') {
            $DEtype = "Mietvertrag";
            $number = $document->contract_number;
            $documentDate = $document->contract_date;
            $note = $document->contract_note;
            $user = $document->user->name;
        }


        $yearShort = Carbon::createFromFormat('d.m.Y', $documentDate)->format('y');

        $data = [
            'document' => $document,
            'number' => $number,
            'DEtype' => $DEtype,
            'documentDate' => $documentDate,
            'note' => $note,
            'user' => $user,
            'yearShort' => $yearShort,
        ];

        $pdf = Pdf::loadView('DocumentToPDF', $data);
        $fileName = $document->current_state . '/' . $number . '.pdf';
        Storage::disk('public')->put($fileName, $pdf->download()->getOriginalContent());
        $generatedPDFLink = asset('storage/' . $fileName);

        return response()->json($generatedPDFLink, Response::HTTP_OK);
    }
}
