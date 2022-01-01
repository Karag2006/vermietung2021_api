<tr>
    <td class="pl txt-bold">Abholdatum:</td>
    <td class="td-info text-right txt-bold pr-2">{{ $document->collectDate ? $document->collectDate->format('d.m.Y') : '' }}</td>
    <td class="pl txt-bold pl-2">Uhrzeit:</td>
    <td class="td-info text-right txt-bold">{{ Str::substr($document->collectTime, 0 , 5) }}</td>
    <td class="pl txt-bold"></td>
    <td class="text-right txt-bold"></td>
</tr>
<tr>
    <td class="pl txt-bold">Rückgabedatum:</td>
    <td class="td-info text-right txt-bold">{{ $document->returnDate ? $document->returnDate->format('d.m.Y') : '' }}</td>
    <td class="pl txt-bold pl-2">Uhrzeit:</td>
    <td class="td-info text-right txt-bold">{{ Str::substr($document->returnTime, 0 , 5) }}</td>
    <td class="pl txt-bold"></td>
    <td class="text-right txt-bold"></td>
</tr>
