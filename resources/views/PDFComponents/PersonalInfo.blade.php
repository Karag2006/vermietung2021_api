<table style="margin-top: 20px" class="mr-t" width="100%">
    <tr>
        <td class="pl txt-bold">Ausweis Nr.:</td>
        <td class="pl txt-bold">Geb. Datum:</td>
        <td class="pl txt-bold">Geb. Ort:</td>
        <td class="pl txt-bold">Kennzeichen Zugfahrzeug:</td>
    </tr>
    <tr>
        <td class="td-info text-left txt-bold">{{ $document->customer_pass_number ?? $document->driver_pass_number}}</td>
        <td class="td-info text-left txt-bold">{{ $document->customer_birth_date ? $document->customer_birth_date : $document->driver_birth_date }}</td>
        <td class="td-info text-left txt-bold">{{ $document->customer_birth_city ?? $document->driver_birth_city}}</td>
        <td class="td-info text-left txt-bold">{{ $document->customer_car_number ?? ($document->driver_car_number ?? '')}}</td>
    </tr>
</table>
