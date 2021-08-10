@extends('layouts.main')

@section('layout_class', 'checklist_layout')

@section('main')

    <div class="checklist-breadcrumb">
        <nav class="navbar navbar-expand-md bg-cl">
            <div class="float-left @yield('category_toggle_btn_class')">
                <a class="btn-toggle-ctg"><i class="fas fa-arrows-alt-h"></i></a>
            </div>
            <ul class="navbar-nav mr-auto">
                @yield('navbar-checklist-navitem')
            </ul>
        </nav>
    </div>

    @include('layouts.content.components.category_sidenav')

    <div class="checklist-container">
        @yield('content')
    </div>

@endsection

{{-- <div class="cover-spin-sidenav">
    <div class="spinner-border text-warning" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div> --}}

{{-- <ul class="navbar-nav mr-auto">
    <li class="nav-item">
        <a class="add-question nav-link waves-effect waves-light disabled"><i class="fa fa-plus"></i> Add Question</a>
    </li>
</ul> --}}