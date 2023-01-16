@php
    $document['selectedEquipmentList'] = json_decode($document['selectedEquipmentList']);
@endphp

<tr>
    <td class="text-left txt-bold txt-lg" colspan="6">Zubehör :</td>
</tr>
<tr>
    <td class="td-info text-left txt-bold" colspan="6">
        @foreach ($document->selectedEquipmentList as $key => $equipment)
            {{ $equipment->number }} x {{ $equipment->name }}&nbsp;&nbsp; | &nbsp;&nbsp;
        @endforeach
    </td>
</tr>
