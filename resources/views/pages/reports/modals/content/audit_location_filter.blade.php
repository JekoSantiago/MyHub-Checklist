<form id="mystore_filter_form">
    <div class="row">
    <div class="form-group col-md-12">
        <label for="checklist">Store</label>
        <select class="form-control" name="store-loc" id="store-loc" aria-placeholder="Choose store">
            <option></option>
            @foreach ($stores as $s)
            @php  $s->Location_ID == $location ? $selected = 'selected' : $selected = '';  @endphp
                <option value="{{ $s->Location_ID }}" {{ $selected }}>{{ $s->LocationCode }} - {{ $s->Location }}</option>
            @endforeach
        </select>
        </div>
      <div class="form-group col-md-12">
        <label for="checklist">Checklist</label>
        <input name="store-cl" id="store-cl" type="text" class="form-control"
        placeholder="Title or description" value="{{ $checklist }}">
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-12">
        <label for="datestart">Date start range</label>
        <input name="store-datestart" id="store-datestart" type="text" class="form-control" value="{{ $datestart }}">
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-12">
        <label for="dateend">Date end range</label>
        <input name="store-dateend" id="store-dateend" type="text" class="form-control" value="{{ $dateend }}">
      </div>
    </div>
  </form>