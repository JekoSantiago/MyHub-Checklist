<a href="{{ config('app.myhub_url') }}"> <img src="https://myhub.atp.ph/resource/style1/img/myhublogo.png" width="280" /></a>

@if($type == 1)

<p>Hi {{ $info[0]->AuditByName }},</p>

<p>{{ $info[0]->AcceptedByName }} has successfully accepted your audit for <b>{{ $info[0]->LocationCode }} - {{ $info[0]->Location }}</b> dated <b>{{ MyHelper::formatDate($info[0]->AuditStartDate) }}</b>.</p>

<p>Visit MyHub : Checklist for more details.</p>

@elseif($type == 2)

<p>Hi {{ $info[0]->AcceptedByName }},</p>

<p>You have successfully accepted the audit of <b>{{ $info[0]->AuditByName }}</b> for store <b>{{ $info[0]->LocationCode }} - {{ $info[0]->Location }}</b> that is dated <b>{{ MyHelper::formatDate($info[0]->AuditStartDate) }}</b>. 

<p>Visit MyHub : Checklist for more details.</p>

@elseif($type == 3)

<p>Hi {{ $info[0]->AC }},</p>

<p>{{ $info[0]->AcceptedByName }} has accepted the audit of <b>{{ $info[0]->AuditByName }}</b> for store <b>{{ $info[0]->LocationCode }} - {{ $info[0]->Location }}</b> that is dated <b>{{ MyHelper::formatDate($info[0]->AuditStartDate) }}</b>.
Please provide your <b>Response and Corrective Actions</b> in the Checklist Application.</p>

<p>Visit MyHub : Checklist for more details.</p>

@else

<p>Hi {{ $info[0]->currAC }},</p>

<p>{{ $info[0]->AcceptedByName }} has accepted the audit of <b>{{ $info[0]->AuditByName }}</b> for store <b>{{ $info[0]->LocationCode }} - {{ $info[0]->Location }}</b> that is dated <b>{{ MyHelper::formatDate($info[0]->AuditStartDate) }}</b>.
Please provide your <b>Response and Corrective Actions</b> in the Checklist Application.</p>
    
<p>Visit MyHub : Checklist for more details.</p>

@endif