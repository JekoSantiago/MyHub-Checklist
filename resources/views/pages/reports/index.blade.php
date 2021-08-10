@extends('layouts.content.default')

@section('content')

<div class="content-heading">
  <div class="d-flex flex-column">
    <h4>Reports</h4>
    <div class="d-flex align-items-center font-weight-bold font-small opacity-75">
      <a class="home-button"><i class="fa fa-home" aria-hidden="true"></i></a>
      <span class="label-dot mx-2"></span>
      <span>Reports</span>
    </div>
  </div>
  <div class="d-flex flex-row">
    <a class="btn btn-custom btn-yellow-3 dropdown-toggle m-1"
      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">Generate Report</a>
    <div class="dropdown-menu dropdown-menu-right">
      <a class="dropdown-item"
        href="#" data-toggle="modal" data-target="#modal_rptsqa_filter"><i
          class="far fa-file-excel"></i><span class="ml-3">SQA Summary</span></a>
    </div>
  </div>
</div>

<div class="card card-custom">
  <div class="card-body">
    <ul class="nav nav-pills myaudit-tab">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#rpt_store_tab">Store Audit</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#rpt_dep_tab">Department Audit</a>
      </li>
      {{-- <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#rpt_answers_tab">Regular Checklist</a>
                </li> --}}
    </ul>
    <div class="tab-content">
      <div class="tab-pane fade active show" id="rpt_store_tab" role="tabpanel">
        <a class="float-right btn-filter waves-effect" data-toggle="modal" data-target="#modal_rptstore_filter"><i
            class="fa fa-filter" aria-hidden="true"></i> Filter</a>
        <div class="table-responsive">
          <table id="tbl-rpt-store" class="table table-custom">
            <thead>
              <tr>
                <th class="th-fit">Actions</th>
                <th>Title</th>
                <th>Store</th>
                <th>Auditee</th>
                <th>Date Start</th>
                <th>Date End</th>
              </tr>
            </thead>
            <tbody>
              <!-- Body Here -->
              <tr>
                <td class="text-center tr-no-record" colspan="6">Apply filter to see existing records
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="tab-pane fade" id="rpt_dep_tab" role="tabpanel">
        <a class="float-right btn-filter waves-effect" data-toggle="modal" data-target="#modal_rptdep_filter"><i
            class="fa fa-filter" aria-hidden="true"></i> Filter</a>
        <div class="table-responsive">
          <table id="tbl-rpt-department" class="table table-custom">
            <thead>
              <tr>
                <th class="th-fit">Actions</th>
                <th>Title</th>
                <th>Location</th>
                <th>Department</th>
                <th>Auditee</th>
                <th>Date Start</th>
                <th>Date End</th>
              </tr>
            </thead>
            <tbody>
              <!-- Body Here -->
              <tr>
                <td class="text-center tr-no-record" colspan="7">Apply filter to see existing records
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      {{-- <div class="tab-pane fade fade-left" id="rpt_answers_tab" role="tabpanel">
                  <a class="float-right btn-filter waves-effect" data-toggle="modal" data-target="#modal_rptanswers_filter"><i
                          class="fa fa-filter" aria-hidden="true"></i> Filter</a>
                  <div class="table-responsive">
                      <table id="tbl-my-department" class="table-audit">
                          <thead>
                              <tr>
                                  <th class="th-fit">Actions</th>
                                  <th>Title</th>
                                  <th>Answered By</th>
                                  <th>Date Start</th>
                                  <th>Date End</th>
                              </tr>
                          </thead>
                          <tbody>
                              <!-- Body Here -->
                              <tr>
                                  <td class="text-center tr-no-record" colspan="5">Apply filter to see existing records
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div> --}}

    </div>
  </div>
</div>


<!-- Modal Audit Department Filter -->
@include('pages.reports.modals.audit_department_filter')
<!-- /Modal Audit Department Filter -->

<!-- Modal Audit Store Filter -->
@include('pages.reports.modals.audit_location_filter')
<!-- /Modal Audit Store Filter -->

{{-- <!-- Modal Answer CL Filter -->
<div class="modal fade" id="modal_rptanswers_filter" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100">Filter</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" name="btn-reset-filter" id="store-reset-filter" class="btn btn-close waves-effect mr-auto">RESET FILTER</button>
        <button type="button" class="btn btn-close waves-effect" data-dismiss="modal">CLOSE</button>
        <button type="button" name="btn-apply-filter" id="btn-apply-filter" class="btn btn-save waves-light"
          data-dismiss="modal">APPLY</button>

          <input type="hidden" name="acl-emp-search" id="acl-emp-search">
          <input type="hidden" name="acl-search" id="acl-search">
          <input type="hidden" name="acl-datestart-search" id="acl-datestart-search">
          <input type="hidden" name="acl-dateend-search" id="acl-dateend-search">
      </div>
    </div>
  </div>
</div>
<!-- /Modal Answer CL Filter --> --}}

<!-- Modal SQA Summary Generation Filter -->
@include('pages.reports.modals.sqa_summary_filter')
<!-- /Modal SQA Summary Generation Filter -->

@endsection

@section('js')

<script type="text/javascript" src="{{asset('assets/js/custom/pages/report.js')}}"></script>

@endsection