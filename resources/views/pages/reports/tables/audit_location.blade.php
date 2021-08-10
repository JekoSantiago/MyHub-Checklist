@if (count($auditstore) > 0)
@foreach ($auditstore as $as)
<tr>
    <td>
        <div class="" style="display: flex;">
            <a class="btn-action bg-btn-action btn-sm" href="{{ url('/view/audit/location/'.$as->AnswerChecklist_ID) }}"
                target="_blank" data-toggle="tooltip" title="View" data-placement="right"><i class="fa fa-eye"></i></a>
            <a class="btn-action bg-btn-action btn-sm" href="{{ url('/export/audit/location/'.$as->AnswerChecklist_ID) }}" data-toggle="tooltip" title="Export" data-placement="right"><i class="fas fa-file-excel" aria-hidden="true"></i></a>
        </div>
    </td>
    <td>{{ $as->Title }}</td>
    <td>[{{ $as->LocationCode }}] - {{ $as->Location }}</td>
    <td>{{ $as->Auditee }}</td>
    <td>{{ MyHelper::formatDate($as->AuditStartDate) }}</td>
    <td>{{ MyHelper::formatDate($as->AuditEndDate) }}</td>
</tr>
@endforeach
@else
<tr>
    <td class="text-center tr-no-record" colspan="6">No records found</td>
</tr>
@endif