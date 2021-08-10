@if (count($checklist) > 0)
@foreach ($checklist as $acl)
@php 
if($acl->SubmitDate == '') : 
    $end = '<span class="badge badge-warning">IN PROGRESS</span>';
else :
    $end = MyHelper::formatDate($acl->SubmitDate);
endif;
@endphp
<tr>
    <td>
        <div class="" style="display: flex;">
            @if ($acl->SubmitDate == '')
                <a class="btn-action bg-btn-action btn-sm" href="{{ url('/answer/'.$acl->AnswerChecklist_ID) }}" data-toggle="tooltip" title="Continue" data-placement="right"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
            @else
                <a class="btn-action bg-btn-action btn-sm" href="{{ url('/answer/view/'.$acl->AnswerChecklist_ID) }}" target="_blank" data-toggle="tooltip" title="View" data-placement="right"><i class="fa fa-eye"></i></a>
                <a class="btn-action bg-btn-action btn-sm" href="{{ url('/answers/export/'.$acl->AnswerChecklist_ID) }}" data-toggle="tooltip" title="Export" data-placement="right"><i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
            @endif
        </div>
    </td>
    <td>{{ $acl->Title }}</td>
    <td>{{ MyHelper::formatDate($acl->InsertDate) }}</td>
    <td>{!! $end !!}</td>
</tr>
@endforeach
@else
<tr>
    <td class="text-center tr-no-record" colspan="4">No records found</td>
</tr>
@endif