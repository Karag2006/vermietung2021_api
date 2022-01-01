@include('PDFComponents.CSSStyle')
<body>
    <div id="invoice-print" class="invoice-print">

        @include('PDFComponents.Header')
        <hr>

        {{--  Start Customer section--}}
        <table class="customerTable">
            @include('PDFComponents.CustomerData')
            @include('PDFComponents.DriverData')
        </table>
        @if ($document->currentState == "contract")
            @include('PDFComponents.PersonalInfo')
        @endif
        {{--  End Customer section--}}


        {{--vehicle section--}}
        <table class="mainTable">
            @include('PDFComponents.VehicleInfo')
            @include('PDFComponents.mainTableSpacer')

            @if ($document->selectedEquipmentList)
                @include('PDFComponents.selectedEquipment')
                @include('PDFComponents.mainTableSpacer')
            @endif

            @if ($document->comment)
            {{-- TODO: add Comment to the documents --}}
                @include('PDFComponents.comment')
                @include('PDFComponents.mainTableSpacer')
            @endif

            @include('PDFComponents.Dates')
            @include('PDFComponents.mainTableSpacer')

            @include('PDFComponents.Prices')
            @include('PDFComponents.mainTableSpacer')

            @include('PDFComponents.bail')

        </table>

        @include('PDFComponents.Note')

        @include('PDFComponents.CollectAdress')

        @if ($document->currentState == 'contract')
            @include('PDFComponents.Signature')
        @endif

        @include('PDFComponents.Footer')

    </div>
</body>
