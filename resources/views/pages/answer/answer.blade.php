@extends('index')


@section('content')

<nav class="sidenav category-nav">
    <div class="sidenav-content">
        <div class="sidenav-header">
            <h5>CATEGORY / SECTION</h5>
        </div>
        <div class="sidenav-body">

        </div>
        <div class="cover-spin-sidenav">
            <div class="spinner-border text-warning" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
</nav>
<div class="checklist-page-content">
    <div class="category-nav-backdrop"></div>
    <div class="checklist-breadcrumb">
        <nav class="navbar navbar-expand-md navbar-light bg-cl">
            <div class="float-left">
                <a class="btn-toggle-ctg"><i class="fa fa-arrows-h"></i></a>
            </div>
        </nav>
    </div>
    <div class="checklist-container answer-checklist">
        <div class="card">
            <div class="card-body">
                <div class="answer-checklist-info">
                    <h3>{{ $answerCL[0]->Title }}</h3>
                    <span>{{ $answerCL[0]->Description }}</span>
                </div>
            </div>
        </div>
        <form class="checklist-form">
            <fieldset>
                <div class="checklist-body">

                </div>
            </fieldset>
        </form>
    </div>
    <div class="cover-spin-content" style="display: none;">
        <div class="spinner-border text-warning" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="floating-fixed">
        <a id="submit-answer" class="btn-lg btn-floating bg-cl my-0 waves-effect waves-light">
            <i class="fa fa-check"></i>
        </a>
    </div>
</div>

<input type="hidden" name="aclID" id="aclID" value="{{ $answerCLID }}">
<input type="hidden" name="active_ctgID" id="active_ctgID" value="">

@endsection

@section('js')

<script type="text/javascript" src="{{asset('assets/js/answer.js')}}"></script>

@endsection