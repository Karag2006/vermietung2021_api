<tr>
    <td class="text-left txt-bold txt-lg">Gesamt :</td>
    <td class="td-info text-right txt-bold pl-2">{{ $document->totalPrice ? number_format($document->totalPrice , 2). " €": ''}}</td>
    <td class="text-left txt-bold txt-lg pl-2">Netto:</td>
    <td class="td-info text-right txt-bold pl-2">{{ $document->nettoPrice ? number_format($document->nettoPrice , 2). " €": ''}}</td>
    <td class="text-left txt-bold txt-lg pl-2">USt. {{ $document->vat }}%:</td>
    <td class="td-info text-right txt-bold pl-2">{{ $document->taxValue ? number_format($document->taxValue , 2). " €": ''}}</td>
</tr>
<tr>
    <td class="text-left txt-bold txt-lg">Anzahlung:</td>
    <td class="td-info text-right txt-bold pl-2">{{ $document->reservationDepositValue ? number_format($document->reservationDepositValue , 2). " €": ''}}</td>
    @if ($document->reservationDepositRecieved)

        <td class="text-left txt-bold txt-lg pl-2">Erhalten:</td>
        <td class="td-info text-right txt-bold pl-2">{{$document->reservationDepositDate ? $document->reservationDepositDate->format('d.m.Y') : ''}}</td>
        <td class="text-left txt-bold txt-lg pl-2">Zahlungsart:</td>
        <td class="td-info text-right txt-bold pl-2">{{ $document->reservationDepositType ?? '' }}</td>

    @else

        <td class="text-left txt-bold txt-lg pl-2">Bis:</td>
        <td class="td-info text-right txt-bold pl-2">{{$document->reservationDepositDate ? $document->reservationDepositDate->format('d.m.Y') : ''}}</td>
        <td class="text-left txt-bold txt-lg pl-2" colspan="2">Erforderlich</td>

    @endif
</tr>
<tr>
    <td class="text-left txt-bold txt-lg">Restzahlung:</td>
    <td class="td-info text-right txt-bold pl-2">{{ $document->finalPaymentValue ? number_format($document->finalPaymentValue , 2). " €": ''}}</td>
    @if ($document->finalPaymentRecieved)

        <td class="text-left txt-bold txt-lg pl-2">Erhalten:</td>
        <td class="td-info text-right txt-bold pl-2">{{$document->finalPaymentDate ? $document->finalPaymentDate->format('d.m.Y') : ''}}</td>
        <td class="text-left txt-bold txt-lg pl-2">Zahlungsart:</td>
        <td class="td-info text-right txt-bold pl-2">{{ $document->finalPaymentType ?? '' }}</td>

    @else
        @if ($document->currentState == "contract")
            <td class="text-left txt-bold txt-lg pl-2">Bis:</td>
            <td class="td-info text-right txt-bold pl-2">{{$document->reservationDepositDate ? $document->reservationDepositDate->format('d.m.Y') : ''}}</td>
            <td class="text-left txt-bold txt-lg pl-2" colspan="2">Erforderlich</td>
        @else
            <td class="text-left txt-bold txt-lg pl-2" colspan="4">Bei Abholung per EC-Karte oder in Bar zu Zahlen</td>
        @endif
    @endif
</tr>
