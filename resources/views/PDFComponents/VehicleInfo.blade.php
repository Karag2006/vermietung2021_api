<tr>
    <td class="tdOne txt-bold">Anhänger</td>
    <td class="tdTwoSpanThree td-info text-left txt-bold" colspan="3">{{ $document->vehicle_title ?? '' }}</td>
    <td class="tdFive text-left txt-bold">{{--Hersteller:--}}</td>
    <td class="tdSix text-left txt-bold txt-lg pl"></td>
</tr>
<tr>
    <td class="tdOne text-left txt-bold txt-lg">Kennzeichen:</td>
    <td class="tdTwoSpanThree td-info text-left txt-bold" colspan="3">{{ $document->vehicle_plateNumber ?? '' }}</td>
    <td class="tdFive text-left txt-bold txt-lg"></td>
    <td class="tdSix text-left txt-bold txt-lg pl"></td>
</tr>
<tr>
    <td class="tdOne text-left txt-bold txt-lg">Fahrgestellnummer:</td>
    <td class="tdTwoSpanThree td-info text-left txt-bold" colspan="3">{{ $document->vehicle_chassisNumber ?? '' }}</td>
    <td class="tdFive text-left txt-bold txt-lg pl-2">Lademaße:</td>
    <td class="tdSix td-info text-left txt-bold">{{ $document->vehicle_loading_size ? implode(" x ", $document->vehicle_loading_size) . ' cm' : '' }}</td>
</tr>
<tr>
    <td class="tdOne text-left txt-bold txt-lg">Zul. Gesamtgewicht:</td>
    <td class="tdTwoSpanThree td-info text-left txt-bold" colspan="3">{{ $document->vehicle_totalWeight ? $document->vehicle_totalWeight . ' kg' : '' }}</td>
    <td class="tdFive text-left txt-bold txt-lg pl-2">Nutzlast:</td>
    <td class="tdSix td-info text-left txt-bold">{{ $document->vehicle_usableWeight ? $document->vehicle_usableWeight . ' kg' : '' }}</td>
</tr>

