@extends('pages.audit.answer.location')

@section('navbar-checklist-navitem')

<li class="nav-item">
    <a href="{{ url('/rca') }}" class="previous-page nav-link waves-effect waves-light"><i class="fa fa-arrow-left"></i> Back to menu</a>
</li>

@endsection

@if ($answerCL[0]->AC_ID == base64_decode(Session::get('Emp_Id')))
    @if (($answerCL[0]->AC_SubmitDate != '' && $answerCL[0]->AppStatus == 1) || ($answerCL[0]->AC_SubmitDate != '' && $answerCL[0]->AppStatus == '') )
        @section('checklist_body_class', 'disabled')
    @endif
@else
    @section('checklist_body_class', 'disabled')
@endif

@section('floating-button')

@if ( $answerCL[0]->AC_SubmitDate == '' || $answerCL[0]->AppStatus == 0 )
<div class="floating-fixed">
    <a id="submit_rca" data-id="{{ $answerCL[0]->AuditLocation_ID }}" class="btn-lg btn-floating bg-cl my-0 waves-effect waves-light">
        <i class="fa fa-check"></i>
    </a>
</div>
@endif

@overwrite

@section('js')
    <script type="text/javascript" src="{{asset('assets/js/custom/pages/answer-rca.js')}}"></script>
@overwrite