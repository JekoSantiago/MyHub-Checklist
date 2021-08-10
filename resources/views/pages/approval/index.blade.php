@extends('layouts.content.default')

@section('content')

<div class="content-heading">
  <div class="d-flex flex-column">
      <h4>My Approval</h4>
      <div class="d-flex align-items-center font-weight-bold font-small opacity-75">
          <a class="home-button"><i class="fa fa-home" aria-hidden="true"></i></a>
          <span class="label-dot mx-2"></span>
          <span>My Approval</span>
      </div>
  </div>
</div>

<div class="card card-custom">
  <div class="card-body">
    <a class="float-right btn-filter waves-effect" data-toggle="modal" data-target="#modal_approval_filter"><i class="fa fa-filter" aria-hidden="true"></i> Filter</a>
      <div class="table-responsive">
          <table id="table_approval" class="table table-custom">
              <thead>
                  <tr>
                      <th class="th-fit"></th>
                      <th>Score</th>
                      <th>Title</th>
                      <th>Store</th>
                      <th>Audit by</th>
                      <th>Date Start</th>
                      <th>Date End</th>
                      <th>Approve / Disapprove Date</th>
                  </tr>
              </thead>
              <tbody>
                  <!-- Body Here -->
                  <tr>
                      <td class="text-center tr-no-record" colspan="8">Apply filter to see existing records
                      </td>
                  </tr>
              </tbody>
          </table>
      </div>
  </div>
</div>

@include('pages.approval.modals.approval_filter')

@endsection

@section('js')

<script type="text/javascript" src="{{asset('assets/js/custom/pages/approval.js')}}"></script>

@endsection