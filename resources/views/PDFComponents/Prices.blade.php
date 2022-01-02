<tr>
    <td class="tdOne text-left txt-bold txt-lg">Gesamt :</td>
    <td class="tdTwo td-info text-right txt-bold pl-2">{{ $document->totalPrice ? number_format($document->totalPrice , 2). " €": ''}}</td>
    <td class="tdThree text-left txt-bold txt-lg pl-2">Netto:</td>
    <td class="tdFour td-info text-right txt-bold pl-2">{{ $document->nettoPrice ? number_format($document->nettoPrice , 2). " €": ''}}</td>
    <td class="tdFive text-left txt-bold txt-lg pl-2">USt. {{ $document->vat }}%:</td>
    <td class="tdSix td-info text-right txt-bold pl-2">{{ $document->taxValue ? number_format($document->taxValue , 2). " €": ''}}</td>
</tr>
<tr>
    <td class="tdOne text-left txt-bold txt-lg">Anzahlung:</td>
    <td class="tdTwo td-info text-right txt-bold pl-2">{{ $document->reservationDepositValue ? number_format($document->reservationDepositValue , 2). " €": ''}}</td>
    @if ($document->reservationDepositRecieved)

        <td class="tdThree text-left txt-bold txt-lg pl-2">Erhalten:</td>
        <td class="tdFour td-info text-right txt-bold pl-2">{{$document->reservationDepositDate ? $document->reservationDepositDate->format('d.m.Y') : ''}}</td>
        <td class="tdFive text-left txt-bold txt-lg pl-2">Zahlungsart:</td>
        <td class="tdSix td-info text-right txt-bold pl-2">{{ $document->reservationDepositType ?? '' }}</td>

    @else

        <td class="tdThree text-left txt-bold txt-lg pl-2">Bis:</td>
        <td class="tdFour td-info text-right txt-bold pl-2">{{$document->reservationDepositDate ? $document->reservationDepositDate->format('d.m.Y') : ''}}</td>
        <td class="tdFiveToEnd text-left txt-bold txt-lg pl-2" colspan="2">Erforderlich</td>

    @endif
</tr>
<tr>
    <td class="tdOne text-left txt-bold txt-lg">Restzahlung:</td>
    <td class="tdTwo td-info text-right txt-bold pl-2">{{ $document->finalPaymentValue ? number_format($document->finalPaymentValue , 2). " €": ''}}</td>
    @if ($document->finalPaymentRecieved)

        <td class="tdThree text-left txt-bold txt-lg pl-2">Erhalten:</td>
        <td class="tdFour td-info text-right txt-bold pl-2">{{$document->finalPaymentDate ? $document->finalPaymentDate->format('d.m.Y') : ''}}</td>
        <td class="tdFive text-left txt-bold txt-lg pl-2">Zahlungsart:</td>
        <td class="tdSix td-info text-right txt-bold pl-2">{{ $document->finalPaymentType ?? '' }}</td>

    @else
        @if ($document->currentState == "contract")
            <td class="tdThree text-left txt-bold txt-lg pl-2">Bis:</td>
            <td class="tdFour td-info text-right txt-bold pl-2">{{$document->reservationDepositDate ? $document->reservationDepositDate->format('d.m.Y') : ''}}</td>
            <td class="tdFiveToEnd text-left txt-bold txt-lg pl-2" colspan="2">Erforderlich</td>
        @else
            <td class="tdThreeToEnd text-left txt-bold txt-lg pl-2" colspan="4">Bei Abholung per EC-Karte oder in Bar zu Zahlen</td>
        @endif
    @endif
</tr>
