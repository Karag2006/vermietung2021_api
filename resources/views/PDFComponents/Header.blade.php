<table CELLSPACING=0 width="100%" style="background-color: #00205c; color: white; font-family: Helvetica !important;" >
    <tr>
        <td width="140" style="text-align: center;"><img class="logo" src="img/logo.jpg" /></td>
        <td class="header-border"><div class="contact">{!! $document->contactdata !!}</div></td>
        <td class="header-border">
            @switch($document->currentState)
                @case("offer")
                    <div class="header-right">Angebot für Mietanhänger</div>
                    <div class="header-right">Nr. : {{$document->offerNumber}}.{{ $document->offerDate->format('y') }}</div>
                    <div class="header-right" style="font-size: small">&nbsp;</div>
                    <div class="header-right">Datum: {{$document->offerDate->format('d.m.Y')}}</div>
                    @break
                @case("reservation")
                    <div class="header-right">Reservierungsbestätigung</div>
                    <div class="header-right">Nr. : {{$document->reservationNumber}}.{{ $document->reservationDate->format('y') }}</div>
                    <div class="header-right" style="font-size: small">&nbsp;</div>
                    <div class="header-right">Datum: {{$document->reservationDate->format('d.m.Y')}}</div>
                    @break
                @default
                    <div class="header-right">Mietvertrag</div>
                    <div class="header-right">Nr. : {{$document->contractNumber}}.{{ $document->contractDate->format('y') }}</div>
                    <div class="header-right" style="font-size: small">&nbsp;</div>
                    <div class="header-right">Datum: {{$document->contractDate->format('d.m.Y')}}</div>
            @endswitch
        </td>
    </tr>
</table>

