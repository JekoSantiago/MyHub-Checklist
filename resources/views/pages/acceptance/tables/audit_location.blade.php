@if (count($auditlocation) > 0)
@foreach ($auditlocation as $al)
<tr>
    <td><a class="btn-accept-audit btn-action bg-btn-action btn-sm" data-id="{{ $al->AuditLocation_ID }}" data-toggle="tooltip" title="Accept Audit" data-placement="right"><i class="fas fa-check" aria-hidden="true"></i></a></td>
    <td>{{ $al->Title }}</td>
    <td>{{ $al->Location }}</td>
    <td>{{ $al->AuditByName }}</td>
    <td>{{ MyHelper::formatDateTime($al->AuditStartDate) }}</td>
    <td>{{ MyHelper::formatDateTime($al->AuditEndDate) }}</td>
</tr>
@endforeach
@else
<tr>
    <td class="text-center tr-no-record" colspan="6">No records found</td>
</tr>
@endif