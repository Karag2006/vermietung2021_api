
<tr>
    <td class="txt-bold">Anhänger</td>
    <td class="td-info td-info-left text-left txt-bold">{{ $document->vehicle_title ?? '' }}</td>
    <td class="text-left txt-bold">{{--Hersteller:--}}</td>
    <td class="text-left txt-bold txt-lg pl"></td>
</tr>
<tr>
    <td class="text-left txt-bold txt-lg">Kennzeichen:</td>
    <td class="td-info td-info-left text-left txt-bold">{{ $document->vehicle_plateNumber ?? '' }}</td>
    <td class="text-left txt-bold txt-lg"></td>
    <td class="text-left txt-bold txt-lg pl"></td>
</tr>
<tr>
    <td class="text-left txt-bold txt-lg">Fahrgestellnummer:</td>
    <td class="td-info td-info-left text-left txt-bold">{{ $document->vehicle_chassisNumber ?? '' }}</td>
    <td class="text-left txt-bold txt-lg pl-2">Lademaße:</td>
    <td class="td-info text-left txt-bold">{{ $document->vehicle_loadingSize ?? '' }}</td>
</tr>
<tr>
    <td class="text-left txt-bold txt-lg">Zul. Gesamtgewicht:</td>
    <td class="td-info td-info-left text-left txt-bold">{{ $document->vehicle_totalWeight ?? '' }}</td>
    <td class="text-left txt-bold txt-lg pl-2">Nutzlast:</td>
    <td class="td-info text-left txt-bold">{{ $document->vehicle_usableWeight ?? '' }}</td>
</tr>

