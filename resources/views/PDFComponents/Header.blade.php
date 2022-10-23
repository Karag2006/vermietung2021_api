<table CELLSPACING=0 width="100%" style="background-color: #00205c; color: white; font-family: Helvetica !important;" >
    <tr>
        <td width="140" style="text-align: center;"><img class="logo" src="img/logo.jpg" /></td>
        <td class="header-border"><div class="contact">{!! $document->contactdata !!}</div></td>
        <td class="header-border">
            @switch($document->current_state)
                @case("offer")
                    <div class="header-right">Angebot für Mietanhänger</div>
                    <div class="header-right">Nr. : {{$document->offer_number}}.{{ $yearShort }}</div>
                    <div class="header-right" style="font-size: small">&nbsp;</div>
                    <div class="header-right">Datum: {{$document->offer_date}}</div>
                    @break
                @case("reservation")
                    <div class="header-right">Reservierungsbestätigung</div>
                    <div class="header-right">Nr. : {{$document->reservation_number}}.{{ $yearShort }}</div>
                    <div class="header-right" style="font-size: small">&nbsp;</div>
                    <div class="header-right">Datum: {{$document->reservation_date}}</div>
                    @break
                @default
                    <div class="header-right">Mietvertrag</div>
                    <div class="header-right">Nr. : {{$document->contract_number}}.{{ $yearShort }}</div>
                    <div class="header-right" style="font-size: small">&nbsp;</div>
                    <div class="header-right">Datum: {{$document->contract_date}}</div>
            @endswitch
        </td>
    </tr>
</table>

