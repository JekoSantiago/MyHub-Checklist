@extends('layouts.content.default')

@section('content')

<div class="content-heading">
  <div class="d-flex flex-column">
      <h4>Audit Department</h4>
      <div class="d-flex align-items-center font-weight-bold font-small opacity-75">
          <a class="home-button"><i class="fa fa-home" aria-hidden="true"></i></a>
          <span class="label-dot mx-2"></span>
          <span>Audit</span>
          <span class="label-dot mx-2"></span>
          <span>Department</span>
      </div>
  </div>
</div>

<div class="card card-custom">
  <div class="card-body">
    <div class="search-container mb-2">
      <div class="row d-flex align-items-center flex-wrap">
        <div class="d-flex align-items-center col-md-5 my-2">
          <input name="department_search" id="department_search" type="text" class="form-control"
          placeholder="Department or office name...">
        </div>
        <button type="button" name="btn-search-department" id="btn-search-department"
          class="btn btn-custom btn-yellow-2 ml-2 waves-effect waves-light">Search</button>
      </div>
    </div>
    <div class="table-responsive">
      <table id="tbl-department" class="table table-custom table-audit">
        <tbody>
          <!-- Body Here -->
          <tr>
            <td class="text-center tr-no-record">Search for the department you want to audit</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

@include('pages.audit.new.modals.department_checklist')

@endsection

@section('js')

<script type="text/javascript" src="{{asset('assets/js/custom/pages/audit-department.js')}}"></script>

@endsection