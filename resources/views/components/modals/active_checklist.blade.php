@if (count($checklist) > 0)
@foreach ($checklist as $cl)
@php
    if($cl->OnGoing == 1) :
        $disabled = 'disabled';
        $status = '<span class="badge badge-warning">IN PROGRESS</span>';
    else :
        $disabled = '';
        $status = '';
    endif;
@endphp
<tr class="row-click {{ $disabled }}" data-clid="{{ $cl->Checklist_ID }}">
    <td><img src="{{asset('assets/images/checklist-icon.png')}}" height="24" alt="Alfamart Logo"></td>
    <td>{{ $cl->Title }}&nbsp;{!! $status !!}</td>
    <td>{{ $cl->CreatedBy }}</td>
</tr>
@endforeach
@else
<tr>
    <td class="text-center tr-no-record" colspan="5">No checklists found</td>
</tr>
@endif