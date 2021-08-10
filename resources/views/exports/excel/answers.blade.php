<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="{{asset('assets/css/export-style.css')}}">

<table>
    <thead>
        <tr>
            <th>Alfamart Trading Philippines Inc.</th>
        </tr>
        <tr>
            <th>Title: {{ $checklist[0]->Title }}</th>
        </tr>
    </thead>
</table>
<table>
    <thead>
        <tr>
            <th style="border: 1px solid #000000;" align="center" width="50">Category / Item</th>
            <th style="border: 1px solid #000000;" align="center" width="30">Text Answer</th>
            <th style="border: 1px solid #000000;" align="center" colspan="{{ $max }}">Options</th>
            <th style="border: 1px solid #000000;" align="center" width="10">Portion</th>
            <th style="border: 1px solid #000000;" align="center" width="10">Score</th>
        </tr>
    </thead>
    <tbody>
        @php $sumRate = 0; @endphp
        @foreach ($category as $p)
        <tr>
            <td style="background-color: #ffcc00; border: 1px solid #000000;" colspan="{{ ($max + 2) }}">
                {{ $p['CategoryName'] }}</td>
            <td style="background-color: #ffcc00; border: 1px solid #000000;" align="center">
                {{ number_format($p['Portion'],0).'%' }}</td>
            <td style="background-color: #ffcc00; border: 1px solid #000000;"></td>
        </tr>
        @foreach ($p['Items'] as $i)
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
            {!! str_repeat("<td style='border: 1px solid #000000;'></td>", ($max - $countOpt)) !!}

            @php $sRate += $o->isSelected == 1 ? $o->Rate : 0 @endphp

            @php $sumRate += $o->isSelected == 1 && $o->AnswerItem_ID == $i['AnswerItem_ID'] ? $o->Rate : 0; @endphp
            @endforeach
            @if (in_array($i['ItemType_ID'], config('app.group_type')))
            <td style="border: 1px solid #000000;" align="center">{{ number_format($i['Portion'],0).'%' }}</td>
            <td style="border: 1px solid #000000;">{{ $sRate }}</td>
            @endif
        </tr>
        @endforeach
        @if (!empty($p['SubCategory']))
        @php $colspan = ($max + 2); @endphp
        {!! MyHelper::showRPTAnswerSubCategory($p['SubCategory'], $colspan, $max) !!}
        @endif

        @endforeach
        <tr>
            <td style="border: 1px solid #000000; background-color: #ffcc99; text-align: right;"
                colspan="{{ ($max + 3) }}"><strong>Total:</strong></td>
            <td style="border: 1px solid #000000; text-align: center; background-color: #ffcc99;">
                <strong>{{ $sumRate }}</strong></td>
        </tr>
    </tbody>
</table>

</html>