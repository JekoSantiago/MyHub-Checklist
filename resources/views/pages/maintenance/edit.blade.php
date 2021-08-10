@extends('layouts.content.checklist')

@section('sidenav-header')

<div class="sidenav-action">
    <button class="btn btn-sm btn-secondary2 waves-effect waves-light" type="button" name="modal-addctg-btn"
        id="addCtg-btn" data-toggle="modal" data-target="#modal_newcategory">
        <i class="fa fa-plus-circle"></i> Add Category</button>
</div>

@endsection

@section('navbar-checklist-navitem')

<li class="nav-item">
    <a class="add-question nav-link waves-effect waves-light disabled"><i class="fa fa-plus"></i> Add
        Question</a>
</li>

@endsection

@section('content')

<div class="card card-custom card-click">
    <div class="card-header">
        <h3 class="card-title">Checklist Information</h1>
    </div>
    <div class="card-body">
        <form id="checklist-form">
            @csrf {{ method_field('POST') }}
            <div class="row">
                <div class="form-group col-md-8">
                    <label for="">Title</label>
                    <input class="form-control" type="text" name="title" id="title" placeholder="Checklist Title"
                        value="{{ $info[0]->Title }}">
                </div>
                <div class="form-group col-md-4">
                    <label for="">Type</label>
                    <select name="type" id="type" class="form-control">
                        @foreach ($type as $t)
                        @php $select = ($info[0]->ChecklistType_ID == $t->ChecklistType_ID ) ?
                        'selected=selected' : ''; @endphp
                        <option value="{{ $t->ChecklistType_ID }}" {{ $select }}>{{ $t->ChecklistType }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input class="form-control form-control-sm" type="text" name="desc" id="desc"
                        placeholder="Checklist Description..." value="{{ $info[0]->Description }}">
                </div>
            </div>
        </form>
    </div>
</div>
<div class="checklist-body">

</div>

<div class="cover-spin-content" style="display: none;">
    <div class="spinner-border text-warning" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

<input type="hidden" name="checklistID" id="checklistID" value="{{ $checklist }}">
<input type="hidden" name="curr_ctgID" id="curr_ctgID" value="">

<div class="alert item-delete-success animated flipInX faster" role="alert">
    Item deleted <a class="alert-link float-right undo-delete" href="#">UNDO</a>
    <input type="hidden" name="del_itemID" id="del_itemID">
</div>

@include('pages.maintenance.modals.add_category')

@endsection

@section('js')

<script type="text/javascript" src="{{asset('assets/js/custom/pages/edit-checklist.js')}}"></script>

@endsection