@extends('layouts.content.default')

@section('content')

<div class="content-heading">
  <div class="d-flex flex-column">
      <h4>Audit Acceptance</h4>
      <div class="d-flex align-items-center font-weight-bold font-small opacity-75">
          <a class="home-button"><i class="fa fa-home" aria-hidden="true"></i></a>
          <span class="label-dot mx-2"></span>
          <span>Audit Acceptance</span>
      </div>
  </div>
</div>

<div class="card card-custom">
    <div class="card-body">
        <div class="table-responsive">
            <table id="table_acceptance" class="table table-custom">
                <thead>
                    <tr>
                        <th class="th-fit"></th>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Audit By</th>
                        <th>Date Start</th>
                        <th>Date End</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Body Here -->
                    <tr>
                        <td class="text-center tr-no-record" colspan="4">Apply filter to see existing records
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('js')

<script type="text/javascript" src="{{asset('assets/js/custom/pages/acceptance.js')}}"></script>

@endsection