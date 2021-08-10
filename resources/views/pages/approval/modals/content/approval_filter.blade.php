<form id="approval_filter_form">
    <div class="row">
    <div class="form-group col-md-12">
        <label for="checklist">Store</label>
        <select class="form-control" name="location" id="location" aria-placeholder="Choose store">
            <option></option>
            @foreach ($stores as $s)
            @php  $s->Location_ID == $location ? $selected = 'selected' : $selected = '';  @endphp
                <option value="{{ $s->Location_ID }}" {{ $selected }}>{{ $s->LocationCode }} - {{ $s->Location }}</option>
            @endforeach
        </select>
        </div>
      <div class="form-group col-md-12">
        <label for="status">Status</label>
        <select class="form-control" name="status" id="status" aria-placeholder="Choose store">
            <option value="0" {{ $status == 0 ? 'selected' : '' }}>For Approval</option>
            <option value="1" {{ $status == 1 ? 'selected' : '' }}>Approved</option>
            <option value="2" {{ $status == 2 ? 'selected' : '' }}>Disapproved</option>
        </select>
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
        <label for="dateapp">Date Disapproved / Approved range</label>
        <input name="dateapp" id="dateapp" type="text" class="form-control" value="{{ $dateapp }}">
      </div>
    </div>
  </form>