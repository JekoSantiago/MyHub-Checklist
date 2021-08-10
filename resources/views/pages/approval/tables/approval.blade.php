@if (count($auditapp) > 0)
@foreach ($auditapp as $app)
<tr>
    <td>
        <a class="btn-action bg-btn-action btn-sm" href="{{ url('/answer/audit/rca/'. $app->AnswerChecklist_ID) }}" data-toggle="tooltip" title="View" data-placement="right"><i class="fas fa-eye" aria-hidden="true"></i></a>
    </td>
    <td>{{ $app->Score }}</td>
    <td>{{ $app->Title }}</td>
    <td>{{ $app->LocationCode }} - {{ $app->Location }}</td>
    <td>{{ $app->AuditByName }}</td>
    <td>{{ MyHelper::formatDateTime($app->AuditStartDate) }}</td>
    <td>{{ MyHelper::formatDateTime($app->AuditEndDate) }}</td>
    <td>{{ $app->AMAppDate != '' ? MyHelper::formatDateTime($app->AMAppDate) : '--' }}</td>
</tr>
@endforeach
@else
<tr>
    <td class="text-center tr-no-record" colspan="8">No records found</td>
</tr>
@endif