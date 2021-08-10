@if (count($auditstore) > 0)
@php $appStatus = '<span class="badge badge-primary">Not Applicable</span>'; @endphp
@foreach ($auditstore as $as)
<tr>
    <td>
        <div class="" style="display: flex;">
            @if($as->Checklist_ID == config('app.store_quality_audit_ID'))
                @if ($as->AuditSubmit == 0 && $as->CLSubmit == 0)
                <a class="btn-action bg-btn-action btn-sm"
                    href="{{ url('/answer/audit/location/'.$as->AnswerChecklist_ID) }}" data-toggle="tooltip"
                    title="Continue" data-placement="right"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                @endif
                @if ($as->AuditSubmit == 0 && $as->CLSubmit == 1)
                <a class="btn-action bg-btn-action btn-sm" href="{{ url('/sqa/menu/'.$as->AuditLocation_ID) }}"
                    data-toggle="tooltip" title="Continue" data-placement="right"><i class="fa fa-arrow-right"
                        aria-hidden="true"></i></a>
                @endif
                @if ($as->AuditSubmit == 1 && $as->CLSubmit == 1)
                <a class="btn-action bg-btn-action btn-sm" href="{{ url('/sqa/menu/'.$as->AuditLocation_ID) }}" data-toggle="tooltip" title="View"
                    data-placement="right"><i class="fa fa-eye"></i></a>
                <a class="btn-action bg-btn-action btn-sm" href="{{ url('/export/audit/location/'.$as->AnswerChecklist_ID) }}" data-toggle="tooltip" title="Export" data-placement="right"><i class="fas fa-file-excel" aria-hidden="true"></i></a>
                @endif
            @else
                @if ($as->AuditSubmit == 0 && $as->CLSubmit == 0)
                <a class="btn-action bg-btn-action btn-sm"
                    href="{{ url('/answer/audit/location/'.$as->AnswerChecklist_ID) }}" data-toggle="tooltip"
                    title="Continue" data-placement="right"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                @else
                <a class="btn-action bg-btn-action btn-sm" href="{{ url('/view/audit/location/'.$as->AnswerChecklist_ID) }}"
                    target="_blank" data-toggle="tooltip" title="View" data-placement="right"><i class="fa fa-eye"></i></a>
                <a class="btn-action bg-btn-action btn-sm" href="{{ url('/export/audit/location/'.$as->AnswerChecklist_ID) }}" data-toggle="tooltip" title="Export" data-placement="right"><i class="fas fa-file-excel" aria-hidden="true"></i></a>
                @endif
            @endif
        </div>
    </td>
    <td>{{ number_format($as->Score, 2) }}</td>
    @php
        if($as->Checklist_ID == config('app.store_quality_audit_ID')) :
            if($as->AuditSubmit == 1 && $as->CLSubmit == 1) :
                $appStatus = '<span class="badge badge-primary">Submitted</span>';
                if($as->AcceptedDate != ''):
                    $appStatus = '<span class="badge badge-primary">Accepted</span>';
                    if($as->AC_SubmitDate != ''):
                        $appStatus = '<span class="badge badge-primary">AC Submitted</span>';
                        if($as->QAAppDate != '' && $as->QAAppStatus == 1):
                            $appStatus = '<span class="badge badge-success">Approved</span>';
                            if($as->AMAppDate != '' && $as->AMAppStatus == 1):
                                $appStatus = '<span class="badge badge-success">AM Approved</span>';
                            elseif($as->AMAppDate != '' && $as->AMAppStatus == 0):
                                $appStatus = '<span class="badge badge-warning">AM Disapproved</span>';
                            endif;
                        elseif($as->QAAppDate != '' && $as->QAAppStatus == 0):
                            $appStatus = '<span class="badge badge-warning">Disapproved</span>';
                        endif;
                    endif;
                endif;
            else:
                $appStatus = '<span class="badge badge-warning">Pending</span>';
            endif;
        endif;
    @endphp
    <td>{!! $appStatus !!}</td>
    <td>{{ $as->Title }}</td>
    <td>[{{ $as->LocationCode }}] - {{ $as->Location }}</td>
    <td>{{ MyHelper::formatDateTime($as->AuditStartDate) }}</td>
    @if ($as->AuditEndDate == '')
    <td> -- </td>
    @else
    <td>{{ MyHelper::formatDateTime($as->AuditEndDate) }}</td>
    @endif
    <td>{{ $as->AcceptedByName == '' ? '--' : $as->AcceptedByName }}</td>
    <td>{{ $as->AcceptedDate == '' ? '--' : MyHelper::formatDateTime($as->AcceptedDate) }}</td>
    <td>{{ $as->AC_FullName == '' ? '--' : $as->AC_FullName }}</td>
    <td>{{ $as->AC_SubmitDate == '' ? '--' : MyHelper::formatDateTime($as->AC_SubmitDate) }}</td>
    <td>{{ $as->QAAppDate == '' ? '--' : MyHelper::formatDateTime($as->QAAppDate) }}</td>
    <td>{{ $as->AMAppName == '' ? '--' : $as->AMAppName }}</td>
    <td>{{ $as->AMAppDate == '' ? '--' : MyHelper::formatDateTime($as->AMAppDate) }}</td>
    <td>{{ $as->Remarks == '' ? '--' : $as->Remarks }}</td>
</tr>
@endforeach
@else
<tr>
    <td class="text-center tr-no-record" colspan="6">No records found</td>
</tr>
@endif