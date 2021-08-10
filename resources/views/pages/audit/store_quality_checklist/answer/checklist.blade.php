@extends('pages.audit.answer.location')

@section('navbar-checklist-navitem')

<li class="nav-item">
    <a href="{{ url('/sqa/menu/'. base64_encode($answerCL[0]->AuditLocation_ID)) }}" class="previous-page nav-link waves-effect waves-light"><i class="fa fa-arrow-left"></i> Back to menu</a>
</li>

@endsection

@if ($answerCL[0]->ChecklistSubmitDate != '')
    @section('checklist_body_class', 'disabled')
@endif

@section('floating-button')
    <!-- No Floating Button -->
@overwrite