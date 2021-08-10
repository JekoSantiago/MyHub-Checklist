@extends('layouts.post_view')

@section('layout_class', 'checklist_layout')

@section('main')

    <div class="checklist-breadcrumb">
        <nav class="navbar navbar-expand-md bg-cl">
            <div class="float-left @yield('category_toggle_btn_class')">
                <a class="btn-toggle-ctg"><i class="fas fa-arrows-alt-h"></i></a>
            </div>
        </nav>
    </div>

    @include('layouts.content.components.category_sidenav')

    <div class="checklist-container">
        @yield('content')
    </div>

@endsection