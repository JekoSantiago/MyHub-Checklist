<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <title>RCA_2020</title>

    <style>
        @page {
            margin: 40px 40px;
        }

        html {
            font-family: sans-serif;
            font-size: 12px;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        body {
            line-height: 1.5384616;
            color: #333333;
            border: 1px solid #000;
            margin: 0;
        }

        header {
            position: relative;
        }

        main {
            position: relative;
        }

        footer {
            position: fixed;
            bottom: 0;
        }

        ul {
			page-break-inside: auto;
        }
        
        div {
            page-break-inside: avoid;
        }

        div.container {
            page-break-inside: auto;
        }

        .page-break {
            page-break-after: always;
        }

        .page-number:before {
            content: "Page: " counter(page);
        }

        .m-0 {
            margin: 0;
        }

        .mb-1 {
            margin-bottom: 0.25rem !important;
        }

        .mb-2 {
            margin-bottom: 0.50rem !important;
        }

        .mb-3 {
            margin-bottom: 0.75rem !important;
        }

        .mb-4 {
            margin-bottom: 1rem !important;
        }

        .p-0 {
            padding: 0;
        }

        .pb-0 {
            padding-bottom: 0 !important;
        }

        .pl-1 {
            padding-left: 0.25rem !important;
        }

        .pl-6 {
            padding-left: 1.50rem !important;
        }

        .text-center {
            text-align: center
        }

        .bordered-div {
            border: 1px solid #000;
            padding: 10px;
        }

        .p-1 {
            padding: 10px;
        }

        .bordered-bottom-div {
            border-bottom: 1px solid #000;
        }

        .bb-0 {
            border-bottom: 0 !important;
        }

        .row {
            /* margin-left: -10px;
            margin-right: -10px; */
        }

        .row:before,
        .row:after {
            content: " ";
            display: table;
        }

        .row:after {
            clear: both;
        }

        .h-100 {
            height: 100%;
        }

        .p-absolute {
            position: absolute;
        }

        .b-0 {
            bottom: 0;
        }

        .r-0 {
            right: 0;
        }

    </style>
</head>

<body>
    <header>
        <div class="bordered-bottom-div p-1">
            <h3 class="m-0 mb-1">ALFAMART TRADING PHILIPPINES INC.</h3>
            <h3 class="m-0">QUALITY ASSURANCE DEPARTMENT</h3>
        </div>
        <div class="bordered-bottom-div p-1">
            <h4 class="m-0 text-center">RESPONSE AND CORRECTIVE ACTION</h4>
        </div>
        <div class="bordered-bottom-div p-1">
            <div class="row">
                <span>Date: {{ MyHelper::RCAformatDate($info[0]->AuditStartDate) }}</span>
            </div>
            <div class="row">
                <span>Store Code / Store Name: {{ $info[0]->LocationCode }} / {{ $info[0]->Location }}</span>
            </div>
            <div class="row">
                <span>Branch: {{ $info[0]->DC }}</span>
            </div>
            <div class="row">
                <span>Subject: FINAL RCA</span>
            </div>
            <div class="row">
                <span>Prepared By: {{ $info[0]->AuditByName }}</span>
            </div>
        </div>
    </header>
    <main>
        <div class="p-1 pb-0">
            <h4 class="m-0 mb-4">LIST OF PROBLEMS/FINDINGS</h4>
            @foreach($category as $c)
            <h4 class="m-0 mb-2" style="margin-left: 0 !important;">{{ $c->CategoryName }}</h4>
            <ul class="p-0 m-0 mb-2" style="list-style: none;">
                @foreach ($items as $i)
                @if ($i->ParentCategory_ID == $c->ParentCategory_ID)
                <li>{{ $i->Number }}. {{ $i->Findings }}</li>
                @endif
                @endforeach
            </ul>
            @endforeach
        </div>
    </main>
    

    <div class="page-break"></div>

    <header>
        <div class="bordered-bottom-div p-1">
            <h3 class="m-0 mb-1">ALFAMART TRADING PHILIPPINES INC.</h3>
            <h3 class="m-0">QUALITY ASSURANCE DEPARTMENT</h3>
        </div>
        <div class="bordered-bottom-div p-1">
            <h4 class="m-0 text-center">RESPONSE AND CORRECTIVE ACTION</h4>
        </div>
        <div class="bordered-bottom-div p-1">
            <div class="row">
                <span>Date: {{ MyHelper::RCAformatDate($info[0]->AuditStartDate) }}</span>
            </div>
            <div class="row">
                <span>Store Code / Store Name: {{ $info[0]->LocationCode }} / {{ $info[0]->Location }}</span>
            </div>
            <div class="row">
                <span>Branch: {{ $info[0]->DC }}</span>
            </div>
            <div class="row">
                <span>Subject: FINAL RCA</span>
            </div>
            <div class="row">
                <span>Prepared By: {{ $info[0]->AuditByName }}</span>
            </div>
        </div>
    </header>
    <main>
        <div class="bordered-bottom-div p-1">
            <h4 class="m-0">AUDITEE FEEDBACK/RESPONSE</h4>
        </div>
        <div class="row p-1">
            <ul class="p-0 m-0 mb-2" style="list-style: none;">
                @foreach ($items as $i)
                    <li>{{ $i->Number }}. {{ $i->Response }}</li>
                @endforeach
            </ul>
        </div>
    </main>

    <div class="page-break"></div>

    <header>
        <div class="bordered-bottom-div p-1">
            <h3 class="m-0 mb-1">ALFAMART TRADING PHILIPPINES INC.</h3>
            <h3 class="m-0">QUALITY ASSURANCE DEPARTMENT</h3>
        </div>
        <div class="bordered-bottom-div p-1">
            <h4 class="m-0 text-center">RESPONSE AND CORRECTIVE ACTION</h4>
        </div>
        <div class="bordered-bottom-div p-1">
            <div class="row">
                <span>Date: {{ MyHelper::RCAformatDate($info[0]->AuditStartDate) }}</span>
            </div>
            <div class="row">
                <span>Store Code / Store Name: {{ $info[0]->LocationCode }} / {{ $info[0]->Location }}</span>
            </div>
            <div class="row">
                <span>Branch: {{ $info[0]->DC }}</span>
            </div>
            <div class="row">
                <span>Subject: FINAL RCA</span>
            </div>
            <div class="row">
                <span>Prepared By: {{ $info[0]->AuditByName }}</span>
            </div>
        </div>
    </header>
    <main>
        <div class="bordered-bottom-div p-1">
            <h4 class="m-0">ACTION TAKEN (AUDITEE)</h4>
        </div>
        <div class="row p-1" style="padding-bottom: 150px !important;">
            <ul class="p-0 m-0 mb-2" style="list-style: none; padding-bottom: 0 !important;">
                @foreach ($items as $i)
                    <li>{{ $i->Number }}. {{ $i->Action }}</li>
                @endforeach
            </ul>
        </div>
        
    </main>
    <div class="p-absolute r-0 m-0" style="bottom: -28px;">
        <div class="text-center" style="height: 150px; width: 150px; border-top: 1px solid black; border-left: 1px solid black; display:inline-block;" >
            <div>
                <span style="text-decoration: underline;">AUDITED BY</span>
            </div>
            <div>
                <img style="vertical-align: bottom; padding-top: 16px;" src="http://10.245.11.47/application/upload-signature/{{ $info[0]->AuditByEmpNo }}.png" height="84" width="140" alt="Audit by signature">
            </div>
            <div>
                <span style="font-size: 10px;">{{ $info[0]->AuditByName }}</span>
            </div>
        </div><div class="text-center" style="height: 150px; width: 150px; border-top: 1px solid black; border-left: 1px solid black; display:inline-block;" >
            <div>
                <span style="text-decoration: underline;">STORE LEADER</span>
            </div>
            <div>
                <img style="vertical-align: bottom; padding-top: 16px;" src="http://10.245.11.47/application/upload-signature/{{ $info[0]->AcceptedEmpNo }}.png" height="84" width="140" alt="Store Leader signature">
            </div>
            <div>
                <span style="font-size: 10px;">{{ $info[0]->AcceptedByName }}</span>
            </div>
        </div>
    </div>

    <div class="page-break"></div>

    <main>
        <div class="container p-1">
            @foreach($category as $c)
                <h1 class="m-0 mb-2">{{ $c->CategoryName }}</h1>
                @foreach ($images as $im)
                    @if ($im['ParentCategory_ID'] == $c->ParentCategory_ID && count($im['Images']) > 0)
                    <div style="position: relative" class="row mb-4">
                        <h2>{{ $im['ItemName'] }}</h2>
                        @foreach($im['Images'] as $file)
                            <img style="margin-top: 1rem; vertical-align: middle;" src="{{ $file['path'] }}" height="200" width="200" alt="">
                        @endforeach
                    </div>
                    @endif
                @endforeach
            @endforeach
        </div>
    </main>    

    <footer>
    </footer>

    <script type="text/php">
        if (isset($pdf)) {
            $text = "Page {PAGE_NUM} of {PAGE_COUNT}";
            $size = 9;
            $font = $fontMetrics->getFont("sans-serif");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = ($pdf->get_width() - $width);
            $y = $pdf->get_height() - 25;
            $pdf->page_text($x, $y, $text, $font, $size);
        }
    </script>
</body>

</html>