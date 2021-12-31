<tr>
    <td class="txt-bold" width="58">Name:</td>
    <td class="td-info">{{ $document->customer_name1 ?? '' }}</td>
    <td class="txt-bold pl-4" width="80">Name2:</td>
    <td class="td-info">{{ $document->customer_name2 ?? '' }}</td>
</tr>
<tr>
    <td class="txt-bold">Straße:</td>
    <td class="td-info">{{ $document->customer_street ?? '' }}</td>
    <td class="txt-bold pl-4">PLZ/Ort:</td>
    <td class="td-info">{{ $document->customer_plz ?? '' }} {{ $document->customer_city ?? '' }}</td>
</tr>
<tr>
    <td class="txt-bold">Telefon:</td>
    <td class="td-info">{{ $document->customer_phone ?? '' }}</td>
    <td class="txt-bold pl-4">eMail Adresse:</td>
    <td class="td-info">{{ $document->customer_email ?? '' }}</td>
</tr>
<tr>
    <td colspan="4" height="12px"> </td>
</tr>
