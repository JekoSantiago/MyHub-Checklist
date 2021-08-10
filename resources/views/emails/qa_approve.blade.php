<a href="{{ config('app.myhub_url') }}"> <img src="https://myhub.atp.ph/resource/style1/img/myhublogo.png" width="280" /></a>

@php 

    $status = 'approved'; 

    if($info[0]->AppStatus == 0) :
        $status= 'disapproved';
    endif;

@endphp

@if($type == 1)

<p>Hi {{ $info[0]->AuditByName }},</p>

<p>You have successfully <b>{{ $status }}</b> {{ $info[0]->AC }}'s Response and Corrective Actions on your audit for <b>{{ $info[0]->LocationCode }} - {{ $info[0]->Location }}</b> dated <b>{{ MyHelper::formatDate($info[0]->AuditStartDate) }}</b>.</p>

<p>Visit MyHub : Checklist for more details.</p>

@elseif($type == 2)

<p>Hi {{ $info[0]->AC }},</p>

<p>{{ $info[0]->AuditByName }} has <b>{{ $status }}</b> your Response and Corrective Actions for store <b>{{ $info[0]->LocationCode }} - {{ $info[0]->Location }}</b> that is dated <b>{{ MyHelper::formatDate($info[0]->AuditStartDate) }}</b>.</p>

@if ($info[0]->AppStatus == 0)
    <p><b>Remarks:</b> {{ $info[0]->Remarks }}</p>
@endif
    
<p>Visit MyHub : Checklist for more details.</p>

@else

<p>Hi {{ $info[0]->AM }},</p>

<p>For your approval, {{ $info[0]->AuditByName }} has <b>{{ $status }}</b> the Response and Corrective Actions for store <b>{{ $info[0]->LocationCode }} - {{ $info[0]->Location }}</b> that is dated <b>{{ MyHelper::formatDate($info[0]->AuditStartDate) }}</b>.</p>
    
<p>Visit MyHub : Checklist for more details.</p>

@endif