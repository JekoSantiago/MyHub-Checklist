@if (count($auditlocation) > 0)
@php $appStatus = '<span class="badge badge-warning">Pending</span>'; @endphp
@foreach ($auditlocation as $al)
<tr>
    <td>
        <a class="btn-action bg-btn-action btn-sm" href="{{ url('/answer/audit/rca/'. base64_encode($al->AnswerChecklist_ID)) }}" data-toggle="tooltip" title="View" data-placement="right"><i class="fas fa-eye" aria-hidden="true"></i></a>
    </td>
    @php
        if($al->AppStatus != ''):
            if( $al->QAAppDate != '' && $al->QAAppStatus == 1 ) :
                $appStatus = '<span class="badge badge-success">QA Approved</span>';
                if($al->AMAppDate != '' && $al->AMAppStatus == 1) :
                    $appStatus = '<span class="badge badge-success">AM Approved</span>';
                elseif($al->AMAppDate != '' && $al->AMAppStatus == 0) :
                    $appStatus = '<span class="badge badge-warning">AM Disapproved</span>';
                endif;
            elseif($al->QAAppDate != '' && $al->QAAppStatus == 0) :
                $appStatus = '<span class="badge badge-warning">QA Disapproved</span>';
            endif;
        endif;
    @endphp
    <td>{!! $appStatus !!}</td>
    <td>{{ $al->Title }}</td>
    <td>{{ $al->Location }}</td>
    <td>{{ $al->AuditByName }}</td>
    <td>{{ MyHelper::formatDateTime($al->AuditStartDate) }}</td>
    <td>{{ MyHelper::formatDateTime($al->AuditEndDate) }}</td>
    <td>{{ $al->Remarks == '' ? '--' : $al->Remarks }}</td>
</tr>
@endforeach
@else
<tr>
    <td class="text-center tr-no-record" colspan="8">No records found</td>
</tr>
@endif