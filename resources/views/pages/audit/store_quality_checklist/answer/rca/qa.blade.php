@extends('pages.audit.answer.location')

@section('navbar-checklist-navitem')

<li class="nav-item">
    <a href="{{ url('/sqa/menu/'. base64_encode($answerCL[0]->AuditLocation_ID)) }}" class="previous-page nav-link waves-effect waves-light"><i class="fa fa-arrow-left"></i> Back to menu</a>
</li>

@endsection

@if ($answerCL[0]->InsertBy == base64_decode(Session::get('Emp_Id')))
    @if ($answerCL[0]->AuditSubmitDate != '')
        @section('checklist_body_class', 'disabled')
    @endif
@else
    @section('checklist_body_class', 'disabled')
@endif

@section('audit-answer-location-modals')
    @include('pages.audit.store_quality_checklist.modals.disapprove_remarks')
@endsection

@section('floating-button')
    @if( ( ($answerCL[0]->AC_SubmitDate != '' && $answerCL[0]->QAAppDate == '') || ($answerCL[0]->QAAppStatus != 1 && $answerCL[0]->QAAppDate != '')) && $answerCL[0]->InsertBy == base64_decode(Session::get('Emp_Id'))  )
        <div class="floating-fixed approve-menu">
            <a class="btn-lg btn-floating bg-cl my-0 waves-effect waves-light">
                <i class="fas fa-bars"></i>
            </a>
            <ul class="list-unstyled">
                <li><a id="btn-approve" data-id="{{ base64_encode($answerCL[0]->AuditLocation_ID) }}" class="btn-md btn-floating bg-success waves-effect waves-light"><i class="fas fa-thumbs-up"></i></a></li>
                <li><a id="btn-disapprove-toggle" data-id="{{ base64_encode($answerCL[0]->AuditLocation_ID) }}" data-toggle="modal" data-target="#modal_disapprove_remarks" class="btn-md btn-floating bg-danger waves-effect waves-light"><i class="fas fa-thumbs-down"></i></a></li>
            </ul>
        </div>
    @else
        <!-- No floating button -->
    @endif
@overwrite

@section('js')
    <script type="text/javascript" src="{{asset('assets/js/custom/pages/answer-rca.js')}}"></script>
@overwrite