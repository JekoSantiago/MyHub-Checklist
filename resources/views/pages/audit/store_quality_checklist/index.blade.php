@extends('layouts.content.default')

@section('content')

<div class="content-heading">
    <div class="d-flex flex-column">
        <h4>Store Quality Audit</h4>
        <div class="d-flex align-items-center font-weight-bold font-small opacity-75">
            <a class="home-button"><i class="fas fa-home" aria-hidden="true"></i></a>
            <span class="label-dot mx-2"></span>
            <span>Audit</span>
            <span class="label-dot mx-2"></span>
            <span>Location</span>
            <span class="label-dot mx-2"></span>
            <span>Store Quality Audit</span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-custom">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between flex-wrap">
                    <div class="">
                        <h5>{{ $info[0]->LocationCode }} {{ $info[0]->Location }} </h5>
                        <label>Score:</label>
                        <span>{{ number_format($info[0]->Score, 2) }}</span>
                    </div>
                    <div class="action-buttons">
                        <div class="d-flex">
                            <a class="btn btn-custom btn-yellow-2 mb-1 mt-1 mr-1 ml-0" href="{{ url('/view/audit/location/'. base64_encode($info[0]->AnswerChecklist_ID)) }}" target="_blank" href="#">View</a>
                            <a class="btn btn-custom btn-green-2 dropdown-toggle m-1 {{ ($info[0]->AMAppDate != '' && $info[0]->AppStatus == 1) ? '' : 'disabled' }}" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" href="#">Export</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ url('/export/audit/location/sqa/'. base64_encode($info[0]->AnswerChecklist_ID).'/'. base64_encode($monitoring[0]->AnswerChecklist_ID) .'/'. base64_encode($focus[0]->AnswerChecklist_ID)) }}"><i class="far fa-file-excel"></i><span class="ml-3">Store Quality Audit</span></a>
                                <a class="dropdown-item" target="_blank" href="{{ url('/export/pdf/audit/location/sqa/'. base64_encode($info[0]->AnswerChecklist_ID).'/'. base64_encode($monitoring[0]->AnswerChecklist_ID) .'/'. base64_encode($focus[0]->AnswerChecklist_ID)) }}"><i class="far fa-file-pdf"></i><span class="ml-3">Store Quality Audit</span></a>
                                <a class="dropdown-item" target="_blank" href="{{ url('/export/audit/location/rca/'. base64_encode($auditID)) }}"><i class="
                                    far fa-file-pdf"></i><span class="ml-3">RCA</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card card-custom min-height-1">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 d-flex">
                        <img class="rounded-circle bg-image-primary p-2 mb-3 mr-3"
                            src="{{asset('assets/images/monitoring.png')}}" alt="">
                        <div class="d-flex align-items-center">
                            <h6 class="mb-4">Monitoring / Checklist Implementation</h6>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12 d-flex align-items-center font-size-14">
                        <span class="mr-2">Progress</span>
                        <div class="progress h-50 w-100">
                            <div class="progress-bar bg-cl" role="progressbar"
                                style="width: {{ number_format((($monitoring[0]->TotalAnswered/$monitoring[0]->RequiredItems) * 100)) }}%;"
                                aria-valuenow="{{ $monitoring[0]->TotalAnswered }}" aria-valuemin="0"
                                aria-valuemax="{{ $monitoring[0]->RequiredItems }}"></div>
                            <input type="hidden" name="monitoring_total_answer" id="monitoring_total_answer"
                                value="{{ $monitoring[0]->TotalAnswered }}">
                            <input type="hidden" name="monitoring_total_required" id="monitoring_total_required"
                                value="{{ $monitoring[0]->RequiredItems }}">
                        </div>
                        <span
                            class="ml-2">{{ number_format((($monitoring[0]->TotalAnswered/$monitoring[0]->RequiredItems) * 100)) }}%</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <a href="{{ url('/answer/audit/monitoring/'. base64_encode($monitoring[0]->AnswerChecklist_ID)) }}"
                            class="btn btn-custom btn-yellow">View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-custom min-height-1">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 d-flex">
                        <img class="rounded-circle bg-image-primary p-2 mb-3 mr-3"
                            src="{{asset('assets/images/focus.png')}}" alt="">
                        <div class="d-flex align-items-center">
                            <h6 class="mb-4 min-height-h6">Focus Items</h6>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12 d-flex align-items-center font-size-14">
                        <span class="mr-2">Progress</span>
                        <div class="progress h-50 w-100">
                            <div class="progress-bar bg-cl" role="progressbar"
                                style="width: {{ number_format((($focus[0]->TotalAnswered/$focus[0]->RequiredItems) * 100)) }}%;"
                                aria-valuenow="{{ $focus[0]->TotalAnswered }}" aria-valuemin="0"
                                aria-valuemax="{{ $focus[0]->RequiredItems }}"></div>
                            <input type="hidden" name="focus_total_answer" id="focus_total_answer"
                                value="{{ $focus[0]->TotalAnswered }}">
                            <input type="hidden" name="focus_total_required" id="focus_total_required"
                                value="{{ $focus[0]->RequiredItems }}">
                        </div>
                        <span
                            class="ml-2">{{ number_format((($focus[0]->TotalAnswered/$focus[0]->RequiredItems) * 100)) }}%</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <a href="{{ url('/answer/audit/focus/'. base64_encode($focus[0]->AnswerChecklist_ID)) }}"
                            class="btn btn-custom btn-yellow">View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-custom min-height-1">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 d-flex">
                        <img class="rounded-circle bg-image-primary p-2 mb-3 mr-3"
                            src="{{asset('assets/images/response.png')}}" alt="">
                        <div class="d-flex align-items-center">
                            <h6 class="mb-4">Response and Corrective Actions</h6>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12 d-flex align-items-center justify-content-between font-size-14">
                        <span class="span-label label-bg-light-red"><i class="fas fa-exclamation-circle"></i> Findings: {{ $storeaudit[0]->Findings }}</span>
                        <span class="span-label label-bg-light-yellow"><i class="fas fa-comment-dots"></i> Response: {{ $storeaudit[0]->Response }}</span>
                        <span class="span-label label-bg-light-green"><i class="fas fa-check-circle"></i> Action: {{ $storeaudit[0]->Action }}</span>
                        <input type="hidden" name="rca_findings" id="rca_findings"
                            value="{{ $storeaudit[0]->Findings }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <a href="{{ url('/answer/audit/rca/'. base64_encode($storeaudit[0]->AnswerChecklist_ID)) }}"
                            class="btn btn-custom btn-yellow">View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card card-custom">
            <div class="card-body">
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row align-items-center mb-1">
                        <span class="p-2 label-bg-light-yellow rounded"><i class="fas fa-user-alt" aria-hidden="true"></i> Audit by:</span>
                        <div class="d-flex flex-column ml-2 font-size-14">
                            <span class="fw-600">{{ $info[0]->AuditByName }}</span>
                            <span class="fw-500 opacity-50">Quality Assurance Officer</span>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-1">
                        <span class="p-2 label-bg-light-green rounded"><i class="fas fa-user-alt" aria-hidden="true"></i> Accepted by:</span>
                        <div class="d-flex flex-column ml-2 font-size-14">
                            <span class="fw-600">{{ $info[0]->AcceptedByName == '' ? '--' : $info[0]->AcceptedByName }}</span>
                            <span class="fw-500 opacity-50">Store Employee</span>
                        </div>
                        
                    </div>
                    <div class="divider"></div>
                    <div class="d-flex">
                        <div class="d-flex flex-row align-items-center mb-1 mr-4">
                            <span class="symbol-label symbol-40 label-bg-light-yellow">AC</span>
                            <div class="d-flex flex-column ml-2 font-size-14">
                                <span class="fw-600">{{ $info[0]->AC == '' ? '--' : $info[0]->AC }}</span>
                                <span class="fw-500 opacity-50">Area Coordinator</span>
                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center mb-1">
                            <span class="symbol-label symbol-40 label-bg-light-yellow">AM</span>
                            <div class="d-flex flex-column ml-2 font-size-14">
                                <span class="fw-600">{{ $info[0]->AM == '' ? '--' : $info[0]->AM }}</span>
                                <span class="fw-500 opacity-50">Area Manager</span>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-custom">
            <div class="card-body">
                @php $disabled = ''; $info[0]->AuditBy != base64_decode(Session::get('Emp_Id')) ? $disabled = 'disabled'
                : ''; @endphp
                <form class="{{ $disabled }}" id="audit_remarks_form" method="POST">
                    <label for="audit_remarks">Remarks</label>
                    <textarea class="form-control" name="audit_remarks" id="audit_remarks"
                        rows="3">{{ $info[0]->AuditRemarks }}</textarea>
                </form>
            </div>
        </div>
    </div>
</div>

@if ($info[0]->AuditEndDate == '' )
<div class="floating-fixed">
    <a id="end_audit" class="btn-lg btn-floating bg-cl my-0 waves-effect waves-light">
        <i class="fas fa-check"></i>
    </a>
</div>
@endif

<input type="hidden" name="audit_ID" id="audit_ID" value="{{ $auditID }}">

@endsection

@section('js')

<script type="text/javascript" src="{{asset('assets/js/custom/pages/store-quality-audit.js')}}"></script>

@endsection