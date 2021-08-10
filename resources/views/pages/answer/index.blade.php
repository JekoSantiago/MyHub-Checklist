@extends('index')

@section('js')
<script type="text/javascript" src="{{asset('assets/js/answer-main.js')}}"></script>
@endsection

@section('content')
<div class="page-content">
  <div class="container">
    <div class="content-heading">
      <div class="heading-title">
        <h4><i class="fa fa-list-ul" aria-hidden="true"></i> My Answers</h4>
      </div>
      <div class="heading-elements">
        <a class="btn-filter waves-effect" data-toggle="modal" data-target="#modal_myanswer_filter"><i
            class="fa fa-filter" aria-hidden="true"></i> Filter</a>
      </div>
    </div>
    <div class="table-responsive">
      <table id="tbl-answered" class="table-audit">
        <thead>
          <tr>
            <th class="th-fit">Action</th>
            <th>Title</th>
            <th>Date Start</th>
            <th>Date End</th>
          </tr>
        </thead>
        <tbody>
          <!-- Body Here -->
          <tr>
            <td class="text-center tr-no-record" colspan="4">Apply filter to see existing records</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Answers Filter -->
<div class="modal fade" id="modal_myanswer_filter" tabindex="-1" role="dialog" aria-labelledby="modal_myanswer_filter"
  aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100">Filter</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" name="btn-reset-filter" id="btn-reset-filter" class="btn btn-close waves-effect mr-auto">RESET FILTER</button>
        <button type="button" class="btn btn-close waves-effect" data-dismiss="modal">CLOSE</button>
        <button type="button" name="btn-apply-filter" id="btn-apply-filter" class="btn btn-save waves-light"
          data-dismiss="modal">APPLY</button>

          <input type="hidden" name="cl-search" id="cl-search">
          <input type="hidden" name="datestart-search" id="datestart-search">
          <input type="hidden" name="dateend-search" id="dateend-search">
          <input type="hidden" name="submit-search" id="submit-search">
      </div>
    </div>
  </div>
</div>
<!-- /Modal Answers Filter -->
@endsection