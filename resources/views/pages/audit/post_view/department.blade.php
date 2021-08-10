@extends('layouts.content.post_view_checklist')

@section('sidenav-header')

<div class="sidenav-header">
    <h5>CATEGORY / SECTION</h5>
</div>

@endsection

@section('content')

<div class="card card-custom">
    <div class="card-body">
        <div class="answer-checklist-info">
            <h3>{{ $answerCL[0]->Title }}</h3>
            <span>{{ $answerCL[0]->Description }}</span>
            <h5>Location: {{ $answerCL[0]->Location }}</span>
            <h5>Department: {{ $answerCL[0]->Department }}</span>
        </div>
    </div>
</div>
<div class="checklist-body disabled">

</div>

<input type="hidden" name="aclID" id="aclID" value="{{ $answerCLID }}">
<input type="hidden" name="active_ctgID" id="active_ctgID" value="">

@endsection

@section('js')

<script type="text/javascript" src="{{asset('assets/js/custom/pages/answer-checklist.js')}}"></script>

@endsection