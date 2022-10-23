<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
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
        $path = 'storage/' . $document->current_state . '/';
        $savePath = public_path($path);
        $fileName = $document->current_state . '-' . $number . '.pdf';
        $pdf->save($savePath . $fileName);

        $generatedPDFLink = url($path . $fileName);

        return response()->json($generatedPDFLink, Response::HTTP_OK);
    }
}
