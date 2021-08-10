@if (count($auditdep) > 0)
@foreach ($auditdep as $ad)
<tr>
    <td>
        <div class="" style="display: flex;">
            <a class="btn-action bg-btn-action btn-sm"
                href="{{ url('/view/audit/department/'.$ad->AnswerChecklist_ID) }}" target="_blank" data-toggle="tooltip"
                title="View" data-placement="right"><i class="fa fa-eye"></i></a>
            <a class="btn-action bg-btn-action btn-sm" href="{{ url('/export/audit/department/'.$ad->AnswerChecklist_ID) }}"
                data-toggle="tooltip" title="Export" data-placement="right"><i class="fa fa-file-excel-o"
                    aria-hidden="true"></i></a>
        </div>
    </td>
    <td>{{ $ad->Title }}</td>
    <td>[{{ $ad->LocationCode }}] - {{ $ad->Location }}</td>
    <td>{{ $ad->Department }}</td>
    <td>{{ $ad->Auditee }}</td>
    <td>{{ MyHelper::formatDate($ad->AuditStartDate) }}</td>
    <td>{{ MyHelper::formatDate($ad->AuditEndDate) }}</td>
</tr>
@endforeach
@else
<tr>
    <td class="text-center tr-no-record" colspan="7">No records found</td>
</tr>
@endif