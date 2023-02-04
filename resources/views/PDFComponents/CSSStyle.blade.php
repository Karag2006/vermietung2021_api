@php
    // Table Column Sizes
    $sizeOne = 35;
    $sizeTwo = 30;
    $sizeThree = 20;
    $sizeFour = 30;
    $sizeFive = 23;
    $sizeSix = 35;
    $size2Span3 = $sizeTwo + $sizeThree + $sizeFour;

    // Note Font Size calculation
    $str_lines = str_word_count($note) / 12;
    $fsize = $str_lines > 12 ? 'smaller' : '';

@endphp

<style>
    @@font-face {
        font-family: 'Verdana';
        font-weight: normal;
        font-style: normal;
        src: url({{ storage_path('fonts/Verdana.ttf') }}) format("truetype");
    }

    @@font-face {
        font-family: 'Verdana';
        font-weight: bold;
        font-style: normal;
        src: url({{ storage_path('fonts/Verdana Bold.ttf') }}) format("truetype");
    }

    body {
        margin: -2mm 0mm -2mm 0mm;
        font-size: 0.7em;
        font-family: "Helvetica";
    }

    #invoice-print {
        padding: 0;
        margin: 0;
    }

    .invoice-print .hidden-print {
        display: none;
    }

    .logo {
        margin-left: auto;
        margin-right: auto;
        width: 220px;
        height: 129px;
        border: 1px solid #000;
    }

    .footer {
        width: 100%;
        text-align: center;
        color: #777;
        border-top: 1px solid #aaa;
        padding: 0px 0;
        font-size: 11px;
        font-family: Arial;

        position: absolute;
        bottom: 0;
        width: 100%;
        height: 50px;
    }

    .text-right {
        text-align: right;
    }

    .text-left {
        text-align: left;
    }

    .txt-center {
        text-align: center;
    }

    .txt-bold {
        font-weight: bold;
    }

    .td-info {
        margin-left: 0px;
        padding: 3px 2px;
        padding-left: 3px;
        background-clip: padding-box;
        border-radius: 0px;
        background-color: #d9d9d9;
        border: 0.01em solid #333;
        font-weight: bold;
        font-family: "Helvetica";
    }

    .td-info-left {
        width: 80mm;
    }

    .header-right {
        padding-top: 0px;
        padding-bottom: 6px;
        margin: 0;
        font-size: 0.9rem;
        font-weight: bold;
        text-align: right;
        font-family: Helvetica !important;
    }

    .header-border {
        border: 1px solid #000;
        padding: 7px;
    }

    .contact {
        font-size: 14px;
    }

    .introduction {
        margin-bottom: 0.5rem;
        font-weight: bold;
    }

    td img {
        display: block;
        margin-left: auto;
        margin-right: auto;

    }

    .pl-4 {
        padding-left: 6px;
    }

    .pl-2 {
        padding-left: 6px;
    }

    .signature {
        width: 100%;
        text-align: left;
        color: #000;
        padding: 0px 0;

        position: absolute;
        bottom: 75px;
    }

    .customerTable {
        width: 100%;
        border-spacing: 0;
        border-collapse: collapse;
    }

    .mainTable {
        width: 100%;
        margin: 30px auto
    }

    .mainTable .tdOne {
        width: {{ $sizeOne }} mm;
    }

    .mainTable .tdTwo {
        width: {{ $sizeTwo }} mm;
    }

    .mainTable .tdThree {
        width: {{ $sizeThree }} mm;
    }

    .mainTable .tdFour {
        width: {{ $sizeFour }} mm;
    }

    .mainTable .tdFive {
        width: {{ $sizeFive }} mm;
    }

    .mainTable .tdTwoSpanThree {
        width: {{ $size2Span3 }} mm;
    }

    .noteHead {
        margin-bottom: 0;
        margin-top: 1em;
        text-decoration: underline;
    }

    .note {
        display: block;
        width: 100%;
        max-height: 200px;
        overflow: hidden;
        margin-bottom: 0;
        font-size: smaller;
    }

    .collectAdressContainer {
        margin-bottom: 7px;
        margin-top: 2.5rem;
    }

    .collectAdressSpan {
        display: block;
        padding-bottom: 6px;
        font-weight: bold
    }

    .bailRowTwo {
        padding-top: 7px;
    }

    .noteBottom {
        position: absolute;
        bottom: 50px;
    }
</style>
