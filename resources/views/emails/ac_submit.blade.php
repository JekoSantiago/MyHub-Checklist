<a href="{{ config('app.myhub_url') }}"> <img src="https://myhub.atp.ph/resource/style1/img/myhublogo.png" width="280" /></a>

@if($type == 1)

<p>Hi {{ $info[0]->AuditByName }},</p>

<p>For your approval, <b>{{ $info[0]->AC }}</b> has successfully submitted his/her Response and Corrective Actions on your audit for <b>{{ $info[0]->LocationCode }} - {{ $info[0]->Location }}</b> dated <b>{{ MyHelper::formatDate($info[0]->AuditStartDate) }}</b>.</p>

<p>Visit MyHub : Checklist for more details.</p>

@elseif($type == 2)

<p>Hi {{ $info[0]->AC }},</p>

<p>You have successfully submitted your Response and Corrective Actions for the audit of <b>{{ $info[0]->AuditByName }}</b> for store <b>{{ $info[0]->LocationCode }} - {{ $info[0]->Location }}</b> that is dated <b>{{ MyHelper::formatDate($info[0]->AuditStartDate) }}</b>.</p>
    
<p>Visit MyHub : Checklist for more details.</p>

@else

<p>Hi {{ $info[0]->AMAppName }},</p>

<p>For your approval, <b>{{ $info[0]->AC }}</b> has successfully submitted his/her Response and Corrective Actions on the audit for <b>{{ $info[0]->LocationCode }} - {{ $info[0]->Location }}</b> dated <b>{{ MyHelper::formatDate($info[0]->AuditStartDate) }}</b>.</p>

<p>Visit MyHub : Checklist for more details.</p>

@endif