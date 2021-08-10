<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="{{asset('assets/css/export-style.css')}}">

<table>
    <thead>
        <tr>
            <th colspan="5">Alfamart Trading Philippines Inc.</th>
        </tr>
        <tr>
            <th colspan="5">Store Quality Audit Form</th>
        </tr>
    </thead>
</table>
<table>
    <thead>
        <tr>
            <th style="border: 1px solid #000000;" align="center" width="50">-</th>
            @foreach ($stores as $s)
                <th style="border: 1px solid #000000;" align="center" width="10">{{ $s['LocationCode'] }} - {{ $s['Location'] }}</th>
            @endforeach
            <th style="border: 1px solid #000000;" colspan="4" align="center">Rate Tally</th>
        </tr>
        <tr>
            <th style="border: 1px solid #000000;" align="center" width="50">QA Audit</th>
            @foreach ($stores as $s)
            <th style="border: 1px solid #000000;" align="center" width="10">Rate</th>
            @endforeach
            <th style="border: 1px solid #000000;" align="center" width="10">0</th>
            <th style="border: 1px solid #000000;" align="center" width="10">1</th>
            <th style="border: 1px solid #000000;" align="center" width="10">2</th>
            <th style="border: 1px solid #000000;" align="center" width="10">3</th>
        </tr>
    </thead>
    <tbody>
        @php $rateCodeTotalZero = 0; @endphp
        @php $rateCodeTotalOne = 0; @endphp
        @php $rateCodeTotalTwo = 0; @endphp
        @php $rateCodeTotalThree = 0; @endphp
        @foreach ($category as $p)
        @if(!empty($p['SubCategory'])):
            @php $rateCodeTotalZero += MyHelper::showRPTRateCodeCount($p['SubCategory'], $stores, 0); @endphp
            @php $rateCodeTotalOne += MyHelper::showRPTRateCodeCount($p['SubCategory'], $stores, 1); @endphp
            @php $rateCodeTotalTwo += MyHelper::showRPTRateCodeCount($p['SubCategory'], $stores, 2); @endphp
            @php $rateCodeTotalThree += MyHelper::showRPTRateCodeCount($p['SubCategory'], $stores, 3); @endphp
        @endif
        <tr>
            <td style="background-color: #ffcc00; border: 1px solid #000000;">{{ $p['CategoryName'] }}</td>
            @foreach ($stores as $s)
            <th style="background-color: #ffcc00; border: 1px solid #000000;" align="center" width="10"></th>
            @endforeach
            <th style="background-color: #ffcc00; border: 1px solid #000000;" align="center" width="10"></th>
            <th style="background-color: #ffcc00; border: 1px solid #000000;" align="center" width="10"></th>
            <th style="background-color: #ffcc00; border: 1px solid #000000;" align="center" width="10"></th>
            <th style="background-color: #ffcc00; border: 1px solid #000000;" align="center" width="10"></th>
        </tr>
        @foreach ($p['Items'] as $i)
        <tr>
            <td style="border: 1px solid #000000;">{{ $i['ItemName'] }}</td>
            {{-- @foreach ($stores as $s)
                @foreach ($s['Items'] as $ai)
                    @if($i['Item_ID'] == $s['Item_ID'])
                        <td>{{ $ai['RateCode'] }}</td>
                    @else
                        <td>-</td>
                    @endif
                @endforeach
            @endforeach --}}
        </tr>
        @endforeach
        @if (!empty($p['SubCategory']))
        @php $colspan = ($max + 2); @endphp
        {!! MyHelper::showRPTSubCategory($p['SubCategory'], $stores, $colspan, $max) !!}
        @endif
        @endforeach
        <tr>
            <td style="border: 1px solid #000000; background-color: #ffcc99; text-align: right;"
            colspan="{{ count($stores) + 1 }}"><strong>Total Score:</strong></td>
            <td style="border: 1px solid #000000; text-align: center; background-color: #ffcc99;"><strong>{{ $rateCodeTotalZero }}</strong></td>
            <td style="border: 1px solid #000000; text-align: center; background-color: #ffcc99;"><strong>{{ $rateCodeTotalOne }}</strong></td>
            <td style="border: 1px solid #000000; text-align: center; background-color: #ffcc99;"><strong>{{ $rateCodeTotalTwo }}</strong></td>
            <td style="border: 1px solid #000000; text-align: center; background-color: #ffcc99;"><strong>{{ $rateCodeTotalThree }}</strong></td>
        </tr>
    </tbody>
</table>

</html>