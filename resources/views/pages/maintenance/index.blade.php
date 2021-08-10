@extends('layouts.content.default')

@section('content')

<div class="content-heading">
  <div class="d-flex flex-column">
    <h4>Checklists</h4>
    <div class="d-flex align-items-center font-weight-bold font-small opacity-75">
      <a class="home-button"><i class="fa fa-home" aria-hidden="true"></i></a>
      <span class="label-dot mx-2"></span>
      <span>Maintenance</span>
      <span class="label-dot mx-2"></span>
      <span>Checklists</span>
    </div>
  </div>
</div>

<div class="card card-custom">
  <div class="card-header flex-wrap border-0 pt-4 pb-0">
    <h3 class="card-title">Created Checklists</h3>
  </div>
  <div class="card-body">
    <div class="search-container mb-2">
      <div class="input-group input-group-custom align-items-center">
        <input name="checklist_search" id="checklist_search" type="text" class="form-control col-md-5"
          placeholder="Title or description..." autocomplete="off">
        <button type="button" name="btn-search-checklist" id="btn-search-checklist"
          class="btn btn-custom btn-yellow-2 ml-2 waves-effect waves-light">Search</button>
      </div>
    </div>
    <div class="table-responsive">
      <table class="maintenance table-checklist">
        <thead>
          <tr>
            <th class="th-fit"></th>
            <th>Title</th>
            <th>Created by</th>
            <th>Date Created</th>
            <th class="th-fit"></th>
          </tr>
        </thead>
        <tbody>
          <!-- Table body -->
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Floating add button -->
<div class="floating-fixed">
  <a data-toggle="modal" data-target="#modal_new_cl" data-toggle="modal"
    class="btn-lg btn-floating bg-cl my-0 waves-effect waves-light add-cl">
    <i class="fa fa-plus"></i>
  </a>
</div>

@include('pages.maintenance.modals.add_checklist')

@endsection

@section('js')

<script type="text/javascript" src="{{asset('assets/js/custom/pages/maintenance.js')}}"></script>

@endsection