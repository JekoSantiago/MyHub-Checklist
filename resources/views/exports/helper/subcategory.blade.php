@php $sumRate = 0; @endphp
@foreach ($category as $p)
<tr>
    <td style="background-color: #ffff99; border: 1px solid #000000;" colspan="{{ ($max + 2) }}">
        {{ $p['CategoryName'] }}</td>
    <td style="background-color: #ffff99; border: 1px solid #000000;" align="center">
        {{ number_format($p['Portion'],0).'%' }}</td>
    <td style="background-color: #ffff99; border: 1px solid #000000;" align="center">{{ number_format($p['Score'],2) }}</td>
    <td style="background-color: #ffff99; border: 1px solid #000000;"></td>
</tr>
@foreach ($p['Items'] as $i)
@if($i['Item_ID'] == config('app.expired_item_ID') && $i['ItemScore'] == 0)
        @php $sumRate = 10; @endphp
@endif
<tr>
    <td style="border: 1px solid #000000;">{{ $i['ItemName'] }}</td>
    @if(!in_array($i['ItemType_ID'], config('app.group_type')))
    <td colspan="{{ ($max + 3) }}" style="border: 1px solid #000000;">{{ $i['Answer'] }}</td>
    @else
    <td style="border: 1px solid #000000;">{{ $i['Answer'] }}</td>
    @endif

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
    <td style="border: 1px solid #000000;" align="center">{{ round($sRate, 2) }}</td>
    @endif
    <td style="border: 1px solid #000000;">{{ $i['OtherRemarks'] }}</td>
</tr>
@endforeach
@if (!empty($p['SubCategory']))
{!! MyHelper::showRPTAnswerSubCategory($p['SubCategory'], $colspan, $max) !!}
@endif

@endforeach