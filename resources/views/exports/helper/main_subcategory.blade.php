@php $rateCodeCountThree = 0; @endphp
@php $rateCodeCountTwo = 0; @endphp
@php $rateCodeCountOne = 0; @endphp
@php $rateCodeCountZero = 0; @endphp
@foreach ($category as $p)
<tr>
    <td style="background-color: #ffff99; border: 1px solid #000000;">{{ $p['CategoryName'] }}</td>
    @foreach ($stores as $s)
        <th style="background-color: #ffff99; border: 1px solid #000000;" align="center" width="10"></th>
    @endforeach
    <th style="background-color: #ffff99; border: 1px solid #000000;" align="center" width="10"></th>
    <th style="background-color: #ffff99; border: 1px solid #000000;" align="center" width="10"></th>
    <th style="background-color: #ffff99; border: 1px solid #000000;" align="center" width="10"></th>
    <th style="background-color: #ffff99; border: 1px solid #000000;" align="center" width="10"></th>
</tr>
    @foreach ($p['Items'] as $i)
    <tr>
        <td style="border: 1px solid #000000;">{{ $i['ItemName'] }}</td>
        @foreach ($stores as $s)
            @foreach ($s['Items'] as $ai)
                @if($i['Item_ID'] == $ai['Item_ID'])
                    @if($ai['RateCode'] == 3)
                        @php $rateCodeCountThree+= 1; @endphp
                    @endif

                    @if($ai['RateCode'] == 2)
                        @php $rateCodeCountTwo+= 1; @endphp
                    @endif

                    @if($ai['RateCode'] == 1)
                        @php $rateCodeCountOne+= 1; @endphp
                    @endif

                    @if($ai['RateCode'] == 0)
                        @php $rateCodeCountZero+= 1; @endphp
                    @endif
                    <td style="border: 1px solid #000000;" align="center" width="10">{{ $ai['RateCode'] }}</td>
                @endif
            @endforeach
        @endforeach
        <td style="border: 1px solid #000000;" align="center">{{ $rateCodeCountZero }}</td>
        <td style="border: 1px solid #000000;" align="center">{{ $rateCodeCountOne }}</td>
        <td style="border: 1px solid #000000;" align="center">{{ $rateCodeCountTwo }}</td>
        <td style="border: 1px solid #000000;" align="center">{{ $rateCodeCountThree }}</td>
        @php $rateCodeCountThree = 0; @endphp
        @php $rateCodeCountTwo = 0; @endphp
        @php $rateCodeCountOne = 0; @endphp
        @php $rateCodeCountZero = 0; @endphp
    </tr>
    @endforeach
    @if (!empty($p['SubCategory']))
    {!! MyHelper::showRPTSubCategory($p['SubCategory'], $stores, $colspan, $max) !!}
    @endif

@endforeach