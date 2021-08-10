<a href="{{ config('app.myhub_url') }}"> <img src="https://myhub.atp.ph/resource/style1/img/myhublogo.png" width="280" /></a>

@if($type == 1)

<p>Hi {{ $info[0]->AuditByName }},</p>

<p>You have successfully submitted your audit for <b>{{ $info[0]->LocationCode }} - {{ $info[0]->Location }}</b> dated <b>{{ MyHelper::formatDate($info[0]->AuditStartDate) }}</b>.</p>

<p>Visit MyHub : Checklist for more details.</p>

@else

<p>Hi {{ $info[0]->Location }},</p>

<p>Quality Assurance officer, <b>{{ $info[0]->AuditByName }}</b> has successfully submitted an audit of your store dated <b>{{ MyHelper::formatDate($info[0]->AuditStartDate) }}</b>. 
Please accept the audit by logging in to your MyHub account, for it to proceed to your Area Coordinator.</p>

<p>Visit MyHub : Checklist for more details.</p>

@endif