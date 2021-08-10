<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <title>{{ $filename }}</title>

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
            /* line-height: 1.5384616; */
            color: #333333;
            margin: 0;
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
            table-layout: fixed;
        }

        .table>thead>tr>th,
        .table>tbody>tr>th,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>tbody>tr>td,
        .table>tfoot>tr>td {
            padding: 3px 3px;
            vertical-align: middle;
            border-top: 1px solid #000;
        }

        .table>thead>tr>th {
            vertical-align: bottom;
            border-bottom: 2px solid #000;
        }

        .table>caption+thead>tr:first-child>th,
        .table>colgroup+thead>tr:first-child>th,
        .table>thead:first-child>tr:first-child>th,
        .table>caption+thead>tr:first-child>td,
        .table>colgroup+thead>tr:first-child>td,
        .table>thead:first-child>tr:first-child>td {
            border-top: 0;
        }

        .table>tbody+tbody {
            border-top: 2px solid #000;
        }

        .table .table {
            background-color: #eeeded;
        }

        .table {
            border-collapse: collapse;
        }

        .table td,
        .table th {
            background-color: #fff;
        }

        .table-bordered>thead>tr>th,
        .table-bordered>tbody>tr>th,
        .table-bordered>tfoot>tr>th,
        .table-bordered>thead>tr>td,
        .table-bordered>tbody>tr>td,
        .table-bordered>tfoot>tr>td {
            border: 1px solid #000;
        }

        .table-bordered>thead>tr>th,
        .table-bordered>thead>tr>td {
            border-bottom-width: 2px;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #000;
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

    </style>

</head>

<body>

    <header>
        <table class="mb-2">
            <thead>
                <tr>
                    <th align="left">Alfamart Trading Philippines Inc.</th>
                </tr>
                <tr>
                    <th align="left">{{ $checklist[0]->Title }}</th>
                </tr>
            </thead>
        </table>
    </header>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="border: 1px solid #000000;" align="center" >Category / Item</th>
                <th style="border: 1px solid #000000;" align="center" colspan="{{ $max }}">Options</th>
                <th style="border: 1px solid #000000;" align="center" >Portion</th>
                <th style="border: 1px solid #000000;" align="center" >Score</th>
                {{-- <th style="border: 1px solid #000000;" align="center" width="50">Other Remarks</th> --}}
            </tr>
        </thead>
        <tbody>
            @php $totalScore = 0; @endphp
            @php $sumRate = 0; @endphp
            @foreach ($category as $p)
            @php $subCategoriesScore = MyHelper::getSubCategoriesScore($p['SubCategory']); @endphp
            @php $sumRate = ($p['Score'] + $subCategoriesScore); @endphp
            @php $totalScore += $sumRate @endphp
            <tr>
                <td style="background-color: #ffcc00; border: 1px solid #000000;" colspan="{{ ($max + 1) }}">
                    {{ $p['CategoryName'] }}</td>
                <td style="background-color: #ffcc00; border: 1px solid #000000;" align="center">
                    {{ number_format($p['Portion'],0).'%' }}</td>
                <td style="background-color: #ffcc00; border: 1px solid #000000;" align="center">{{ $sumRate }}</td>
            </tr>
            @foreach ($p['Items'] as $i)
            <tr>
                <td style="border: 1px solid #000000;">{{ $i['ItemName'] }}</td>
                @php $sRate = 0; @endphp
                @php $countOpt = count($i['Options']); @endphp
                @foreach ($i['Options'] as $o)
                @php $o->isSelected == 1 ? $color = '#80ffaa' : $color = '' @endphp
                <td style="background-color: {{ $color }}; border: 1px solid #000000;">{{ $o->OptionName }}</td>

                @php $sRate += $o->isSelected == 1 ? $o->Rate : 0 @endphp

                @endforeach
                @if($countOpt > 0)
                {!! str_repeat("<td style='border: 1px solid #000000;'></td>", ($max - $countOpt)) !!}
                @endif
                @if (in_array($i['ItemType_ID'], config('app.group_type')))
                <td style="border: 1px solid #000000;" align="center">{{ number_format($i['Portion'],0).'%' }}</td>
                <td style="border: 1px solid #000000;" align="center">{{ $sRate }}</td>
                @endif
                <td style="border: 1px solid #000000;">{{ $i['OtherRemarks'] }}</td>
            </tr>
            @endforeach
            @if (!empty($p['SubCategory']))
            @php $colspan = ($max + 1); @endphp
            {!! MyHelper::showPDFRPTAnswerSubCategory($p['SubCategory'], $colspan, $max) !!}
            @endif

            @endforeach
            <tr>
                <td style="border: 1px solid #000000; background-color: #ffcc99; text-align: right;"
                    colspan="{{ ($max + 2) }}"><strong>Total:</strong></td>
                <td style="border: 1px solid #000000; text-align: center; background-color: #ffcc99;">
                    <strong>{{ $totalScore }}</strong></td>
            </tr>
        </tbody>
    </table>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="border: 1px solid #000000;" align="center" colspan="2">MONITORING / CHECKLISTS IMPLEMENTATION
                </th>
                <th style="border: 1px solid #000000;" align="center" colspan="2">STATUS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mcategory as $mc)
            @foreach ($mc['Items'] as $mci)
            <tr>
                <td style="border: 1px solid #000000;" colspan="2">{{ $mci['ItemName'] }}</td>
                @foreach ($mci['Options'] as $mcio)
                @php $mcio->isSelected == 1 ? $color = 'background-color: #80ffaa;' : $color = '' @endphp
                <td style="{{ $color }} border: 1px solid #000000;">{{ $mcio->OptionName }}</td>
                @endforeach
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="border: 1px solid #000000;" align="center" colspan="2">FOCUS</th>
                <th style="border: 1px solid #000000;" align="center" colspan="2">STATUS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fcategory as $fc)
            @foreach ($fc['Items'] as $fci)
            <tr>
                <td style="border: 1px solid #000000;" colspan="2">{{ $fci['ItemName'] }}</td>
                @foreach ($fci['Options'] as $fcio)
                @php $fcio->isSelected == 1 ? $color = 'background-color: #80ffaa;' : $color = '' @endphp
                <td style="{{ $color }} border: 1px solid #000000;">{{ $fcio->OptionName }}</td>
                @endforeach
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>

    <table class="mb-4" style="width: 100%;">
        <thead>
            <tr>
                <th align="left">OTHER COMMENTS / REMARKS:</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td align="left">{{ $checklist[0]->Remarks }}</td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%;">
        <thead>
            <tr>
                <th><img style="vertical-align: bottom; padding-top: 16px;" src="http://10.245.11.47/application/upload-signature/{{ $checklist[0]->AuditByEmpNo }}.png" alt="Store Leader signature"></th>
                <th></th>
                <th><img style="vertical-align: bottom; padding-top: 16px;" src="http://10.245.11.47/application/upload-signature/{{ $checklist[0]->AcceptedByEmpNo }}.png" alt="Store Leader signature"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th align="center">Audited By:</th>
                <th align="center">Noted By:</th>
                <th align="center">Accepted By:</th>
            </tr>
            <tr>
                <td align="center">{{ $checklist[0]->AuditByName }}</td>
                <td align="center">{{ $checklist[0]->AC }} / {{ $checklist[0]->AMAppName }}</td>
                <td align="center">{{ $checklist[0]->AcceptedByName }}</td>
            </tr>
        </tbody>
    </table>

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