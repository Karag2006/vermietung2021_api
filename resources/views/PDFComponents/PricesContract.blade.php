<tr>
    <td class="tdOne text-left txt-bold txt-lg">Gesamt :</td>
    <td class="tdTwo td-info text-right txt-bold pl-2">
        {{ $document->total_price ? number_format($document->total_price, 2) . ' €' : '' }}</td>
    <td class="tdThree text-left txt-bold txt-lg pl-2">Netto:</td>
    <td class="tdFour td-info text-right txt-bold pl-2">
        {{ $document->netto_price ? number_format($document->netto_price, 2) . ' €' : '' }}</td>
    <td class="tdFive text-left txt-bold txt-lg pl-2">USt. {{ $document->vat }}%:</td>
    <td class="tdSix td-info text-right txt-bold pl-2">
        {{ $document->tax_value ? number_format($document->tax_value, 2) . ' €' : '' }}</td>
</tr>
@if ($document->reservation_deposit_value > 0)
    <tr>
        <td class="tdOne text-left txt-bold txt-lg">Anzahlung:</td>
        <td class="tdTwo td-info text-right txt-bold pl-2">
            {{ $document->reservation_deposit_value ? number_format($document->reservation_deposit_value, 2) . ' €' : '' }}
        </td>
        @if ($document->reservation_deposit_recieved)
            <td class="tdThree text-left txt-bold txt-lg pl-2">Erhalten:</td>
            <td class="tdFour td-info text-right txt-bold pl-2">{{ $document->reservation_deposit_date ?? '' }}</td>
            <td class="tdFive text-left txt-bold txt-lg pl-2">Zahlungsart:</td>
            <td class="tdSix td-info text-right txt-bold pl-2">{{ $document->reservation_deposit_type ?? '' }}</td>
        @else
            <td class="tdThree text-left txt-bold txt-lg pl-2">Bis:</td>
            <td class="tdFour td-info text-right txt-bold pl-2">{{ $document->reservation_deposit_date ?? '' }}</td>
            <td class="tdFiveToEnd text-left txt-bold txt-lg pl-2" colspan="2">Erforderlich</td>
        @endif
    </tr>
@endif
<tr>
    <td class="tdOne text-left txt-bold txt-lg">Restzahlung:</td>
    <td class="tdTwo td-info text-right txt-bold pl-2">
        {{ $document->final_payment_value ? number_format($document->final_payment_value, 2) . ' €' : '' }}</td>
    @if ($document->final_payment_recieved)

        <td class="tdThree text-left txt-bold txt-lg pl-2">Erhalten:</td>
        <td class="tdFour td-info text-right txt-bold pl-2">{{ $document->final_payment_date ?? '' }}</td>
        <td class="tdFive text-left txt-bold txt-lg pl-2">Zahlungsart:</td>
        <td class="tdSix td-info text-right txt-bold pl-2">{{ $document->final_payment_type ?? '' }}</td>
    @else
        @if ($document->current_state == 'contract')
            <td class="tdThree text-left txt-bold txt-lg pl-2">Bis:</td>
            <td class="tdFour td-info text-right txt-bold pl-2">
                {{ $document->final_payment_date ?? '' }}
            </td>
            <td class="tdFiveToEnd text-left txt-bold txt-lg pl-2" colspan="2">Erforderlich</td>
        @else
            <td class="tdThreeToEnd text-left txt-bold txt-lg pl-2" colspan="4">Bei Abholung per EC-Karte oder in Bar
                zu Zahlen</td>
        @endif
    @endif
</tr>
