<div class="text-left txt-bold" style="margin-bottom: 0px; margin-top: 17px;text-decoration: underline;">Zusatzbemerkungen / Hinweise :</div>

@php
    $str_lines = str_word_count( $note )/12;
    $fsize =  ($str_lines > 12) ? 'smaller': '' ;
@endphp

<div style="font-size: {{$fsize}};
    display:block;
    width:100%;
    max-height:200px;
    overflow:hidden;
    ">
    {!! $note !!}
</div>
