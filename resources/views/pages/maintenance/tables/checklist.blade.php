@if (count($checklist) > 0)
@foreach ($checklist as $cl)
<tr class="row-click" data-clid="{{ $cl->Checklist_ID }}">
    <td><img src="{{asset('assets/images/checklist-icon.png')}}" height="24" alt="Alfamart Logo"></td>
    <td>{{ $cl->Title }}</td>
    <td>{{ $cl->CreatedBy }}</td>
    <td>{{ MyHelper::formatDate($cl->InsertDate) }}</td>
    <td>
        @if ($cl->isActive == 1)
        <a class="btn-action bg-btn-action btn-sm waves-effect deactivate-cl" data-id="{{ $cl->Checklist_ID }}" data-toggle="tooltip" title="Deactivate" data-placement="right" ><i class="fa fa-times" aria-hidden="true"></i></a>
        @else
        <a class="btn-action bg-btn-action btn-sm waves-effect activate-cl" data-id="{{ $cl->Checklist_ID }}" data-toggle="tooltip" title="Activate" data-placement="right"><i class="fa fa-check" aria-hidden="true"></i></a>
        @endif
        
        <a class="btn-action bg-btn-action btn-sm waves-effect delete-cl" data-id="{{ $cl->Checklist_ID }}"  data-toggle="tooltip" title="Remove" data-placement="right"><i class="fa fa-trash" aria-hidden="true"></i></a>
    </td>
</tr>
@endforeach
@else
<tr>
    <td class="text-center tr-no-record" colspan="5">No checklists found</td>
</tr>
@endif