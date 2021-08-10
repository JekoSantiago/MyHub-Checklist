
@php $sumRate = 0; @endphp
@foreach ($category as $p)
<tr>
    <td style="background-color: #ffff99; border: 1px solid #000000;" colspan="{{ ($max + 1) }}">
        {{ $p['CategoryName'] }}</td>
    <td style="background-color: #ffff99; border: 1px solid #000000;" align="center">
        {{ number_format($p['Portion'],0).'%' }}</td>
    <td style="background-color: #ffff99; border: 1px solid #000000;" align="center">{{ number_format($p['Score'],2) }}</td>
</tr>
@foreach ($p['Items'] as $i)
<tr>
    <td style="border: 1px solid #000000; width: 30%;">{{ $i['ItemName'] }}</td>
    @php $sRate = 0; @endphp
    @php $color = ''; @endphp
    @php $countOpt = count($i['Options']); @endphp
    @foreach ($i['Options'] as $o)
    @php $o->isSelected == 1 ? $color = 'background-color: #80ffaa;' : $color = ''; @endphp
    <td style="{{ $color }} border: 1px solid #000000;">{{ $o->OptionName }}</td>
    @php $sRate += $o->isSelected == 1 ? $o->Rate : 0 @endphp
    @endforeach
    @if($countOpt > 0)
    {!! str_repeat("<td style='border: 1px solid #000000;'></td>", ($max - $countOpt)) !!}
    @endif
    @if (in_array($i['ItemType_ID'], config('app.group_type')))
    <td style="border: 1px solid #000000; width: 8%;" align="center">{{ number_format($i['Portion'],0).'%' }}</td>
    <td style="border: 1px solid #000000; width: 8%;" align="center">{{ $sRate }}</td>
    @endif
    {{-- <td style="border: 1px solid #000000;">{{ $i['OtherRemarks'] }}</td> --}}
</tr>
@endforeach
@if (!empty($p['SubCategory']))
{!! MyHelper::showPDFRPTAnswerSubCategory($p['SubCategory'], $colspan, $max) !!}
@endif

@endforeach