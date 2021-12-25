<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use PDF;

class DocumentController extends Controller
{

    public function downloadPDF($id)
    {
        $document = Document::where("id", $id)->first();

        if ($document->currentState == 'offer') {
            $DEtype = "Angebot";
            $number = $document->offerNumber;
            $documentDate = $document->offerDate;
            $note = $document->offer_note;
        }
        if ($document->currentState == 'reservation') {
            $DEtype = "Reservierung";
            $number = $document->reservationNumber;
            $documentDate = $document->reservationDate;
            $note = $document->reservation_note;
        }
        if ($document->currentState == 'contract') {
            $DEtype = "Mietvertrag";
            $number = $document->contractNumber;
            $documentDate = $document->contractDate;
            $note = $document->contract_note;
        }

        $data = [
            'document' => $document,
            'number' => $number,
            'DEtype' => $DEtype,
            'documentDate' => $documentDate,
            'note' => $note,
        ];

        $pdf = PDF::loadView('DocumentToPDF', $data);
        $path = 'storage/' . $document->currentState . '/';
        $savePath = public_path($path);
        $fileName = $document->currentState . '-' . $number . '.pdf';
        $pdf->save($savePath . $fileName);

        $generatedPDFLink = url($path . $fileName);

        return response()->json($generatedPDFLink);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }
}
