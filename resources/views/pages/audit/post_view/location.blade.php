@extends('layouts.content.post_view_checklist')

@if (count($answerCategory) < 2)

    @section('category_nav_toggle_class', 'category-nav-collapse single_category')
    @section('category_toggle_btn_class', 'd-none')

@else

    @section('sidenav-header')

    <div class="sidenav-header">
        <h5>CATEGORY / SECTION</h5>
    </div>

    @endsection

@endif


@section('content')

<div class="card card-custom">
    <div class="card-body">
        <div class="answer-checklist-info">
            <h3>{{ $answerCL[0]->Title }}</h3>
            <span>{{ $answerCL[0]->Description }}</span>
            <h5>Location: {{ $answerCL[0]->Location }}</span>
        </div>
    </div>
</div>
<div class="checklist-body disabled">

</div>

<input type="hidden" name="aclID" id="aclID" value="{{ $answerCLID }}">
@php $aCTG_ID = ''; count($answerCategory) < 2 ? $aCTG_ID = $answerCategory[0]->AnswerCategory_ID : '' @endphp
<input type="hidden" name="active_ctgID" id="active_ctgID" value="{{ $aCTG_ID }}">
<input type="hidden" name="categoryCount" id="categoryCount" value="{{ count($answerCategory) }}">

@yield('audit-answer-location-modals')

@endsection

@section('js')

<script type="text/javascript" src="{{asset('assets/js/custom/pages/answer-checklist.js')}}"></script>

@endsection