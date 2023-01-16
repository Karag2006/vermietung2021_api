@include('PDFComponents.CSSStyle')

<body>
    <div id="invoice-print" class="invoice-print">
        @include('PDFComponents.Header')
        <hr>


        @if ($document->current_state == 'contract')
            @include('PDFComponents.ContractIntroduction')
        @endif
        {{--  Start Customer section --}}
        <table class="customerTable">
            @include('PDFComponents.CustomerData')
            @include('PDFComponents.DriverData')
        </table>
        @if ($document->current_state == 'contract')
            @include('PDFComponents.PersonalInfo')
        @endif
        {{--  End Customer section --}}


        {{-- vehicle section --}}
        <table class="mainTable">
            @include('PDFComponents.VehicleInfo')
            @include('PDFComponents.mainTableSpacer')

            @if (
                !is_null($document['selectedEquipmentList']) &&
                    $document['selectedEquipmentList'] != 'null' &&
                    $document['selectedEquipmentList'] != '[]')
                @include('PDFComponents.selectedEquipment')
                @include('PDFComponents.mainTableSpacer')
            @endif

            @if ($document->comment)
                @include('PDFComponents.comment')
                @include('PDFComponents.mainTableSpacer')
            @endif

            @include('PDFComponents.Dates')
            @include('PDFComponents.mainTableSpacer')

            @include('PDFComponents.Prices')
            @include('PDFComponents.mainTableSpacer')

            @if ($document->contract_bail > 0)
                @include('PDFComponents.bail')
            @endif

        </table>

        @include('PDFComponents.Note')

        @include('PDFComponents.CollectAdress')

        @if ($document->current_state == 'contract')
            @include('PDFComponents.Signature')
        @endif

        @include('PDFComponents.Footer')

    </div>
</body>
