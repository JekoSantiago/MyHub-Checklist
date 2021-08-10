@extends('layouts.content.default')

@section('content')

<div class="content-heading">
    <div class="d-flex flex-column">
        <h4>My Audit</h4>
        <div class="d-flex align-items-center font-weight-bold font-small opacity-75">
            <a class="home-button"><i class="fa fa-home" aria-hidden="true"></i></a>
            <span class="label-dot mx-2"></span>
            <span>My Audit</span>
        </div>
    </div>
</div>

<div class="card card-custom">
    <div class="card-body">
        <ul class="nav nav-pills myaudit-tab">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#my_audit_store">Store</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#my_audit_department">Department</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active show" id="my_audit_store" role="tabpanel">
                <a class="float-right btn-filter waves-effect" data-toggle="modal"
                    data-target="#modal_mystore_filter"><i class="fa fa-filter" aria-hidden="true"></i> Filter</a>
                <div class="table-responsive">
                    <table id="tbl-my-store" class="table table-custom">
                        <thead>
                            <tr>
                                <th class="th-fit"></th>
                                <th class="th-fit"> Score</th>
                                <th>Status</th>
                                <th>Title</th>
                                <th>Store</th>
                                <th>Date Start</th>
                                <th>Date End</th>
                                <th>Accepted By</th>
                                <th>Accepted Date</th>
                                <th>Area Coordinator</th>
                                <th>AC Submit Date</th>
                                <th>Approve / Disapprove Date</th>
                                <th>Area Manager</th>
                                <th>AM Approve / Disapprove Date</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Body Here -->
                            <tr>
                                <td class="text-center tr-no-record" colspan="15">Apply filter to see existing records
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="my_audit_department" role="tabpanel">
                <a class="float-right btn-filter waves-effect" data-toggle="modal" data-target="#modal_mydep_filter"><i
                        class="fa fa-filter" aria-hidden="true"></i> Filter</a>
                <div class="table-responsive">
                    <table id="tbl-my-department" class="table table-custom">
                        <thead>
                            <tr>
                                <th class="th-fit"></th>
                                <th class="th-fit"> Score</th>
                                <th>Title</th>
                                <th>Location</th>
                                <th>Department</th>
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
        </div>
    </div>
</div>

@include('pages.audit.modals.department_filter')

@include('pages.audit.modals.location_filter')

@endsection

@section('js')

<script type="text/javascript" src="{{asset('assets/js/custom/pages/my-audit.js')}}"></script>

@endsection