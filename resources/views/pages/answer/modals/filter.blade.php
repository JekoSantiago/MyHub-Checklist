<form id="myanswer_filter_form">
    <div class="row">
      <div class="form-group col-md-12">
        <label for="checklist">Checklist</label>
        <input name="checklist" id="checklist" type="text" class="form-control"
        placeholder="Title or description" value="{{ $checklist }}">
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-12">
        <label for="datestart">Date start range</label>
        <input name="datestart" id="datestart" type="text" class="form-control" value="{{ $datestart }}">
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-12">
        <label for="dateend">Date end range</label>
        <input name="dateend" id="dateend" type="text" class="form-control" value="{{ $dateend }}">
      </div>
    </div>
    <div class="custom-control custom-checkbox">
        @php $issubmit == 1 ? $checked = 'checked' : $checked = ''; @endphp
      <input class="custom-control-input" type="checkbox" name="isSubmit" id="isSubmit" {{ $checked }}>
      <label class="custom-control-label" for="isSubmit">Submitted</label>
    </div>
  </form>