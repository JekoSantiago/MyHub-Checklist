@if (count($store) > 0)
@foreach ($store as $s)
<tr class="audit-click" data-toggle="modal" data-target="#modal_acl_store" data-loc="{{ $s->Location_ID }}">
    <td class="th-fit"><img src="{{asset('assets/images/small-store.png')}}" height="40" alt=""></td>
    <td>[{{ $s->LocationCode }}]&nbsp;{{ $s->Location }}</td>
</tr>
@endforeach
@else
<tr>
    <td class="text-center tr-no-record" colspan="2">No records found</td>
</tr>
@endif