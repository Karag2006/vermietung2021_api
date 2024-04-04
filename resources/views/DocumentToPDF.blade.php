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

            @includeUnless($document->current_state == 'contract', 'PDFComponents.mainTableSpacer')

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
            @includeUnless($document->current_state == 'contract', 'PDFComponents.mainTableSpacer')

            @if ($document->current_state == 'contract')
                @include('PDFComponents.PricesContract')
            @else
                @include('PDFComponents.Prices')
            @endif
            @include('PDFComponents.mainTableSpacer')

            @includeUnless($document->current_state == 'contract', 'PDFComponents.mainTableSpacer')

            
            @include('PDFComponents.bail')
            

        </table>

        @if ($document->current_state == 'contract')
            @include('PDFComponents.Note')

            @include('PDFComponents.CollectAdress')

            @include('PDFComponents.Signature')
        @else
            @include('PDFComponents.CollectAdress')
            <div class="noteBottom">

                @include('PDFComponents.Note')
            </div>
        @endif

        @include('PDFComponents.Footer')

    </div>
</body>
