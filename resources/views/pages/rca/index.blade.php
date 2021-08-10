@extends('layouts.content.default')

@section('content')

<div class="content-heading">
    <div class="d-flex flex-column">
        <h4>Response and Corrective Actions</h4>
        <div class="d-flex align-items-center font-weight-bold font-small opacity-75">
            <a class="home-button"><i class="fa fa-home" aria-hidden="true"></i></a>
            <span class="label-dot mx-2"></span>
            <span>Response and Corrective Actions</span>
        </div>
    </div>
</div>

<div class="card card-custom">
    <div class="card-body">
        <div class="search-container">
            <div class="row d-flex align-items-center flex-wrap">
                <div class="d-flex align-items-center col-md-5 my-2">
                    <label for="location_search" class="m-0 mr-2">Store:</label>
                    <select class="form-control select2-search" name="location_search" id="location_search" aria-placeholder="Choose store">
                        <option></option>
                        @foreach ($stores as $s)
                            <option value="{{ $s->Location_ID }}">{{ $s->LocationCode }} - {{ $s->Location }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="px-3">
                    <div class="my-2 custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="isSubmit" id="isSubmit">
                        <label class="custom-control-label" for="isSubmit">Submitted</label>
                      </div>
                </div>
                        <button type="button" name="btn-search-rca" id="btn-search-rca"
                    class="btn btn-custom btn-yellow-2 ml-2 waves-effect waves-light">Search</button>
            </div>
        </div>
        <div class="table-responsive">
            <table id="table_rca" class="table table-custom">
                <thead>
                    <tr>
                        <th class="th-fit"></th>
                        <th>Approval Status</th>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Audit By</th>
                        <th>Date Start</th>
                        <th>Date End</th>
                        <th>Remarks</th>
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

@endsection

@section('js')

<script type="text/javascript" src="{{asset('assets/js/custom/pages/rca.js')}}"></script>

@endsection