<style>
    @@font-face{
        font-family: 'Verdana';
        font-weight: normal;
        font-style: normal;
        src: url({{ storage_path('fonts/Verdana.ttf') }}) format("truetype");
    }

    @@font-face{
        font-family: 'Verdana';
        font-weight: bold;
        font-style: normal;
        src: url({{ storage_path('fonts/Verdana Bold.ttf') }}) format("truetype");
    }
    body
    {
        margin: -2mm 0mm -2mm 0mm;
        font-size: x-small;
        font-family: "Helvetica";
    }
    #invoice-print{
        padding: 0;
        margin: 0;
    }
    .invoice-print .hidden-print{
        display: none;
    }
    .logo{
        margin-left: auto;
        margin-right: auto;
        width: 220px;
        height: 129px;
        border: 1px solid   #000;
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
    .text-right{
        text-align: right;
    }
    .text-left{
        text-align: left;
    }
    .txt-center{
        text-align: center;
    }
    .txt-bold{
        font-weight: bold;
    }
    .td-info{
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
        padding-top: 0;
        padding-bottom: 6px;
        margin-top: 0;
        margin-bottom: 0;
        font-size: 18px;
        font-weight: bold;
        text-align: right;
        font-family: Helvetica !important;
    }
   .header-border{
       border: 1px solid   #000;
       padding: 7px;
   }
    .contact{
        font-size: 14px;
    }
    td img{
        display: block;
        margin-left: auto;
        margin-right: auto;

    }
    .pl-4{
        padding-left: 6px;
    }
    .pl-2{
        padding-left: 6px;
    }

    .signature {
        width: 100%;
        text-align: left;
        color: #000;
        padding: 0px 0;

        position: absolute;
        bottom: 55px;
    }

    .customerTable{
        width: 100%;
        border-spacing: 0;
        border-collapse: collapse;
    }

    .mainTable{
        width: 100%;
        margin: 30px auto
    }

</style>
