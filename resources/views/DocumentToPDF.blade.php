
{{--<link href="http://127.0.0.1:8000/css/bootstrap.min.css" rel="stylesheet" />--}}
<style>
    body
    {
        margin: -2mm 0mm -2mm 0mm;
    }
    #invoice-print{
        padding: 0;
        margin: 0;
    }
    .invoice-print .hidden-print{
        display: none;
    }
    .logo{
    /*  max-width: 120px;*/
        margin-left: auto;
        margin-right: auto;
        width: 220px;
        height: 129px;
        border: 1px solid   #000;
    }
    .footer {
        width: 100%;
        text-align: center;
        color: #777;
        border-top: 1px solid #aaa;
        padding: 0px 0;
        font-size: 11px;
        font-family: Arial;

        position: absolute;
        bottom: 0;
        width: 100%;
        height: 50px;
    }
    .text-right{
        text-align: right;
    }
    .text-left{
        text-align: left;
    }
    .txt-center{
        text-align: center;
    }
    .txt-bold{
        font-weight: bold;
    }
    .td-info{
        margin-left: 0px;
        padding: 3px 2px;
        padding-left: 3px;
        background-clip: padding-box;
        border-radius: 0px;
        background-color: #d9d9d9;
        border: 0.01em solid #333;
        font-weight: bold;
        font-family: Helvetica !important;

    }
   .header-right {
        padding-top: 0;
        padding-bottom: 6px;
        margin-top: 0;
        margin-bottom: 0;
       font-size: 18px;
       font-weight: bold;
       text-align: right;
       font-family: Helvetica !important;
    }
   .header-border{
       border: 1px solid   #000;
       padding: 7px;
   }
    .contact{
    }
    td img{
        display: block;
        margin-left: auto;
        margin-right: auto;

    }
    .pl-4{
        padding-left: 6px;
    }
    .pl-2{
        padding-left: 6px;
    }
    textarea{

    }

    .bottom_element {
        width: 100%;
        text-align: left;
        color: #000;
        padding: 0px 0;

        position: absolute;
        bottom: 55px;
        width: 100%;
    }

</style>

<body>
    {{-- TODO: Add All Settings to the Document so they are available for the PDF --}}
<div id="invoice-print" class="invoice-print">
        {{--   starts header section--}}

    <table CELLSPACING=0 width="100%" style="background-color: #00205c; color: white; font-family: Helvetica !important;" >
    <tr>
        <td width="140" style="text-align: center;"><img class="logo" src="img/logo.jpg" /></td>
        <td class="header-border"><div class="contact">{{ $document->contactdata }}</div></td>
        <td class="header-border" valign="top">
            <div class="header-right">{{ $DEtype }} für Mietanhänger</div>
            <div class="header-right">Nr. : {{$number}}.{{ $documentDate->format('y') }}</div>
            <div class="header-right">Datum: {{$documentDate->format('d.m.Y')}}</div>
        </td>
    </tr>
    </table>
        <hr>
        {{--   end header section--}}

      {{--  Start Customer section--}}
        <table CELLSPACING=0 width="100%">
            <tr>
                <td class="txt-bold" width="57">Name:</td>
                <td class="td-info">{{ $document->customer_name1 ?? '' }}</td>
                <td class="txt-bold pl-4" width="80">Name2:</td>
                <td class="td-info">{{ $document->customer_name2 ?? '' }}</td>
            </tr>
            <tr>
                <td class="txt-bold">Straße:</td>
                <td class="td-info">{{ $document->customer_street ?? '' }}</td>
                <td class="txt-bold pl-4">PLZ/Ort:</td>
                <td class="td-info">{{ $document->customer_plz ?? '' }} {{ $document->customer_city ?? '' }}</td>
            </tr>
            <tr>
                <td class="txt-bold">Telefon:</td>
                <td class="td-info">{{ $document->customer_phone ?? '' }}</td>
                <td class="txt-bold pl-4">eMail Adresse:</td>
                <td class="td-info">{{ $document->customer_email ?? '' }}</td>
            </tr>
            <tr>
                <td colspan="4" height="12px"> </td>
               </tr>
            <tr>
                <td > </td>
                <td  ></td>
                <td class="txt-bold pl-4">Mitarbeiter: </td>
                <td class="td-info"> {{ $document->username ?? '' }}</td>
            </tr>
        </table>
        {{--  End Customer section--}}


        {{--vehicle section--}}

        <table class="mr-t pt-2" width="100%">
            <tr>
                <td></td>
                <td  class="text-left txt-bold txt-lg">&nbsp;</td>
                <td class="text-left txt-bold txt-lg pl">&nbsp;</td>
            </tr>
            <tr>
                <td width="175" class="txt-bold">{{ $DEtype }} für folgenden Anhänger:</td>
                <td width="110" class="text-left txt-bold">Anhänger:</td>
                <td  class="text-left txt-bold txt-lg pl">{{ $document->vehicle_title ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left txt-bold txt-lg">Kennzeichen:</td>
                <td  class="text-left txt-bold txt-lg pl">{{ $document->vehicle_plateNumber ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left txt-bold txt-lg">Nutzlast:</td>
                <td class="text-left txt-bold txt-lg pl">{{ $document->vehicle_usableWeight ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-left txt-bold txt-lg">Zul. Gesamtgewicht:</td>
                <td class="text-left txt-bold txt-lg pl">{{ $document->vehicle_totalWeight ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td  class="text-left txt-bold txt-lg">Lademaße:</td>
                <td class="text-left txt-bold txt-lg pl">{{ $document->vehicle_loadingSize ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td  class="text-left txt-bold txt-lg">&nbsp;</td>
                <td class="text-left txt-bold txt-lg pl">&nbsp;</td>
            </tr>
            {{-- TODO: Add the selectedEquipmentList to the PDF in a usable way --}}
            {{-- @if ($document->vehicle_accessories_details->count() > 0)
            <tr>
                <td class="text-left txt-bold txt-lg" colspan="3">Zubehör :</td>
            </tr>
            <tr>
                <td class="td-info text-left txt-bold" colspan="3">
                    @foreach($document->vehicle_accessories_details as $key => $vehicle_accessories_details)
                        {{ $vehicle_accessories_details->title }}&nbsp;&nbsp; | &nbsp;&nbsp;
                    @endforeach
                </td>
            </tr>

            @endif --}}
            <tr>
                <td></td>
                <td  class="text-left txt-bold txt-lg">&nbsp;</td>
                <td class="text-left txt-bold txt-lg pl">&nbsp;</td>
            </tr>
            {{-- TODO: add Comment to the documents --}}
            {{-- @if ($document->comment)
            <tr>
                <td class="td-info text-left txt-bold" colspan="3">
                    {!! nl2br($document->comment ?? '') !!}
                </td>
            </tr>

            @endif --}}
        </table>

        <hr class="mr-t" size="1" width="300" align="center">
        <table class="mr-t" width="50%">
            <tr>
                <td class="pl txt-bold">Abholdatum:</td>
                <td class="td-info text-left txt-bold">{{ $document->collectDate ? $document->collectDate->format('d.m.Y') : '' }}</td>
                <td class="pl txt-bold">Uhrzeit:</td>
                <td class="td-info text-left txt-bold">{{ Str::substr($document->collectTime, 0 , 5) }}</td>
            </tr>
            <tr>
                <td class="pl txt-bold">Rückgabedatum:</td>
                <td class="td-info text-left txt-bold">{{ $document->returnDate ? $document->returnDate->format('d.m.Y') : '' }}</td>
                <td class="pl txt-bold">Uhrzeit:</td>
                <td class="td-info text-left txt-bold">{{ Str::substr($document->returnTime, 0 , 5) }}</td>
            </tr>
        </table>


        <div class="text-left txt-bold" style="margin-bottom: 0px; margin-top: 17px;text-decoration: underline;">Zusatzbemerkungen / Hinweise :</div>

        @php
            $str_lines = str_word_count( $note )/12;
            $fsize =  ($str_lines > 12) ? 'smaller': '' ;
        @endphp

        <div style="font-size: {{$fsize}};
            display:block;
            width:100%;
            max-height:200px;
            overflow:hidden;
            ">
            {!! $note !!}
        </div>

        <table cellpadding="1" class="mr-t" width="100%">
            <tr>
                <td class="text-left txt-bold txt-lg">Mietpreis incl. {{ $document->vat }}% USt für den genannten Zeitraum :</td>
                <td width="75" class="td-info text-right txt-bold pl-2">{{ $document->totalPrice ? number_format($document->totalPrice , 2). " €": ''}}</td>
            </tr>
            <tr>
                <td class="text-left txt-bold txt-lg">Anzahlung bis {{$document->reservationDepositDate ? $document->reservationDepositDate->format('d.m.Y') : ''}} erforderlich :</td>
                <td width="75" class="td-info text-right txt-bold pl-2">{{ $document->reservationDepositValue ? number_format($document->reservationDepositValue , 2)  .' €': '' }}</td>
            </tr>
            <tr>
                <td class="text-left txt-bold txt-lg">Kaution in bar bei Abholung zu hinterlegen :</td>
                <td width="75" class="td-info text-right txt-bold pl-2">{{ $document->contractBail ? number_format($document->contractBail , 2) ." €" : "" }}</td>
            </tr>
        </table>
        {{-- TODO: expand document to inlude the collect Adress --}}
        {{-- <div style="margin-bottom: 7px; margin-top: 7px;">
            <span style="display:block; padding-bottom:8px; font-weight: bold"> Abholanschrift : {{ App\Offer::PICK_UP_ADDRESS_SELECT[$document->pick_up_address] ?? '' }}</span>
            Das Fahrzeug kann nur zum genannten Abholtermin in Empfang genommen werden!
        </div> --}}



        <footer class="footer">
           {!! $document->document_footer !!}
        </footer>

</div>

</body>
