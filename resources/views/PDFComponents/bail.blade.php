<tr>
    <td class="text-left txt-bold txt-lg">Kaution:</td>
    <td class="td-info text-right txt-bold pl-2">{{ $document->contractBail ? number_format($document->contractBail , 2) ." €" : "" }}</td>

    @if ($document->currentState == 'contract')

        <td class="text-left txt-bold txt-lg pl-2">Erhalten:</td>
        <td class="text-left txt-bold pl-2">_____________</td>
        <td class="text-left txt-bold txt-lg pl-2">Erstattet :</td>
        <td class="text-left txt-bold pl-2">_____________</td>

    @else

        <td class="text-left txt-bold txt-lg pl-2" colspan="4">
            Bei Abholung in Bar zu hinterlegen
        </td>

    @endif

</tr>
@if ($document->currentState == 'contract')

    <tr>
        <td class="text-left txt-bold txt-lg"></td>
        <td class="td-info text-right txt-bold pl-2"></td>
        <td class="td-info text-left txt-bold">{{ $document->contractBailDate ? $document->contractBailDate->format('d.m.Y') : '' }}</td>
        <td class="td-info text-left txt-bold">{{ $document->contractBailType ?? '' }}</td>
        <td class="td-info text-left txt-bold">{{ $document->contractBailReturnDate ? $document->contractBailReturnDate->format('d.m.Y') : '' }}</td>
        <td class="td-info text-left txt-bold">{{ $document->contractBailReturnType ?? '' }}</td>
    </tr>

@endif
