<tr>
    <td class="tdOne pl txt-bold">Abholdatum:</td>
    <td class="tdTwo td-info text-right txt-bold pr-2">{{ $document->collect_date ? $document->collect_date : '' }}</td>
    <td class="tdThree pl txt-bold pl-2">Uhrzeit:</td>
    <td class="tdFour td-info text-right txt-bold">{{ Str::substr($document->collect_time, 0 , 5) }}</td>
    <td class="tdFive pl txt-bold"></td>
    <td class="tdSix text-right txt-bold"></td>
</tr>
<tr>
    <td class="tdOne pl txt-bold">Rückgabedatum:</td>
    <td class="tdTwo td-info text-right txt-bold">{{ $document->return_date ? $document->return_date : '' }}</td>
    <td class="tdThree pl txt-bold pl-2">Uhrzeit:</td>
    <td class="tdFour td-info text-right txt-bold">{{ Str::substr($document->return_time, 0 , 5) }}</td>
    <td class="tdFive pl txt-bold"></td>
    <td class="tdSix text-right txt-bold"></td>
</tr>
