<tr>
    <td class="tdOne text-left txt-bold txt-lg">Kaution:</td>
    <td class="tdTwo td-info text-right txt-bold pl-2">{{ $document->contractBail ? number_format($document->contractBail , 2) ." €" : "" }}</td>

    @if ($document->currentState == 'contract')

        <td class="tdThree text-left txt-bold txt-lg pl-2">Erhalten:</td>
        <td class="tdFour text-left txt-bold pl-2">_____________</td>
        <td class="tdFive text-left txt-bold txt-lg pl-2">Erstattet :</td>
        <td class="tdSix text-left txt-bold pl-2">_____________</td>

    @else

        <td class="tdThreeToEnd text-left txt-bold txt-lg pl-2" colspan="4">
            Bei Abholung in Bar zu hinterlegen
        </td>

    @endif

</tr>
@if ($document->currentState == 'contract')

    <tr class="bailRowTwo">
        <td class="tdOne text-left txt-bold txt-lg">&nbsp;</td>
        <td class="tdTwo text-right txt-bold pl-2"></td>
        @if ($document->contractBailRecieved)
            <td class="tdThree td-info text-left txt-bold">{{ $document->contractBailDate ? $document->contractBailDate->format('d.m.Y') : '' }}</td>
            <td class="tdFour td-info text-left txt-bold">{{ $document->contractBailType ?? '' }}</td>
        @else
            <td class="tdThree td-info text-left txt-bold"></td>
            <td class="tdFour td-info text-left txt-bold"></td>
        @endif
        @if ($document->contractBailReturned)
            <td class="tdFive td-info text-left txt-bold">{{ $document->contractBailReturnDate ? $document->contractBailReturnDate->format('d.m.Y') : '' }}</td>
            <td class="tdSix td-info text-left txt-bold">{{ $document->contractBailReturnType ?? '' }}</td>
        @else
            <td class="tdFive td-info text-left txt-bold"></td>
            <td class="tdSix td-info text-left txt-bold"></td>
        @endif
    </tr>

@endif
