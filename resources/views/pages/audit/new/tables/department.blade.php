@if (count($department) > 0)
@foreach ($department as $dep)
<tr class="audit-click" data-toggle="modal" data-target="#modal_acl_dep" data-loc="{{ $dep->Location_ID }}" data-dep="{{ $dep->Department_ID }}">
    <td class="th-fit"><img src="{{asset('assets/images/office.png')}}" height="40" alt=""></td>
    <td class="th-fit">{{ $dep->LocationCode }} - {{ $dep->Location }}</td>
    <td>{{ $dep->Department }}</td>
</tr>
@endforeach
@else
<tr>
    <td class="text-center tr-no-record" colspan="3">No records found</td>
</tr>
@endif