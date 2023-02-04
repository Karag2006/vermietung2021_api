<tr>
    <td class="tdOne text-left txt-bold txt-lg" colspan="5">
        Mietpreis incl. {{ $document->vat }}% USt für den genannten Zeitraum :
    </td>
    <td class="tdSix td-info text-right txt-bold pl-2">
        {{ $document->total_price ? number_format($document->total_price, 2) . ' €' : '' }}
    </td>
</tr>
@if ($document->reservation_deposit_value > 0)
    <tr>
        @if ($document->reservation_deposit_recieved)
            <td class="tdOne text-left txt-bold txt-lg">Anzahlung erhalten am:</td>
            <td class="tdTwo td-info text-right txt-bold pl-2">
                {{ $document->reservation_deposit_date ?? '' }}
            </td>

            <td class="tdThree text-right txt-bold pl-2" colspan="2">Zahlungsart:</td>
            <td class="tdFive td-info text-left txt-bold txt-lg pl-2">
                {{ $document->reservation_deposit_type ?? '' }}
            </td>
            <td class="tdSix td-info text-right txt-bold pl-2">
                {{ $document->reservation_deposit_value ? number_format($document->reservation_deposit_value, 2) . ' €' : '' }}
            </td>
        @else
            <td class="tdOne text-left txt-bold txt-lg">Anzahlung bis:</td>
            <td class="tdTwo td-info text-right txt-bold pl-2">
                {{ $document->reservation_deposit_date ?? '' }}
            </td>

            <td class="tdThree text-left txt-bold pl-2" colspan="3">erforderlich :</td>
            <td class="tdSix td-info text-right txt-bold pl-2">
                {{ $document->reservation_deposit_value ? number_format($document->reservation_deposit_value, 2) . ' €' : '' }}
            </td>
        @endif
    </tr>
@endif
<tr>
    <td class="tdOne text-left txt-bold txt-lg" colspan="5">
        Restzahlung Bei Abholung per EC-Karte oder in Bar zu Zahlen:
    </td>
    <td class="tdSix td-info text-right txt-bold pl-2">
        {{ $document->final_payment_value ? number_format($document->final_payment_value, 2) . ' €' : '' }}
    </td>
</tr>
