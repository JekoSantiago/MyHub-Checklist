@extends('pages.audit.answer.location')

@section('navbar-checklist-navitem')

<li class="nav-item">
    <a href="{{ url('/myapproval') }}" class="previous-page nav-link waves-effect waves-light"><i class="fa fa-arrow-left"></i> Back to My Approval</a>
</li>

@endsection

@section('checklist_body_class', 'disabled')

@section('audit-answer-location-modals')
    @include('pages.audit.store_quality_checklist.modals.disapprove_remarks')
@endsection

@section('floating-button')
    @if( ($answerCL[0]->AMAppStatus != 1 && $answerCL[0]->AMAppDate != '') || $answerCL[0]->AMAppDate == '' )
        <div class="floating-fixed approve-menu">
            <a class="btn-lg btn-floating bg-cl my-0 waves-effect waves-light">
                <i class="fas fa-bars"></i>
            </a>
            <ul class="list-unstyled">
                <li><a id="btn-approve" data-id="{{ base64_encode($answerCL[0]->AuditLocation_ID) }}" class="btn-md btn-floating bg-success waves-effect waves-light"><i class="fas fa-thumbs-up"></i></a></li>
                <li><a id="btn-disapprove-toggle" data-id="{{ base64_encode($answerCL[0]->AuditLocation_ID) }}" data-toggle="modal" data-target="#modal_disapprove_remarks" class="btn-md btn-floating bg-danger waves-effect waves-light"><i class="fas fa-thumbs-down"></i></a></li>
            </ul>
        </div>
    @endif
@overwrite

@section('js')
    <script type="text/javascript" src="{{asset('assets/js/custom/pages/answer-rca.js')}}"></script>
@overwrite