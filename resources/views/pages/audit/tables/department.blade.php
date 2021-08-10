@if (count($auditdep) > 0)
@foreach ($auditdep as $ad)
<tr>
    <td>
        <div class="" style="display: flex;">
            @if ($ad->AuditSubmit == 0 && $ad->CLSubmit == 0)
            <a class="btn-action bg-btn-action btn-sm"
                href="{{ url('/answer/audit/department/'.$ad->AnswerChecklist_ID) }}" data-toggle="tooltip"
                title="Continue" data-placement="right"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
            @else
            <a class="btn-action bg-btn-action btn-sm"
                href="{{ url('/view/audit/department/'.$ad->AnswerChecklist_ID) }}" target="_blank" data-toggle="tooltip"
                title="View" data-placement="right"><i class="fa fa-eye"></i></a>
            <a class="btn-action bg-btn-action btn-sm" href="{{ url('/export/audit/department/'.$ad->AnswerChecklist_ID) }}"
                data-toggle="tooltip" title="Export" data-placement="right"><i class="fa fa-file-excel-o"
                    aria-hidden="true"></i></a>
            @endif
        </div>
    </td>
    <td>{{ number_format($ad->Score, 2) }}</td>
    <td>{{ $ad->Title }}</td>
    <td>[{{ $ad->LocationCode }}] - {{ $ad->Location }}</td>
    <td>{{ $ad->Department }}</td>
    <td>{{ MyHelper::formatDateTime($ad->AuditStartDate) }}</td>
    @if ($ad->AuditEndDate == '')
    <td> -- </td>
    @else
    <td>{{ MyHelper::formatDateTime($ad->AuditEndDate) }}</td>
    @endif

</tr>
@endforeach
@else
<tr>
    <td class="text-center tr-no-record" colspan="7">No records found</td>
</tr>
@endif