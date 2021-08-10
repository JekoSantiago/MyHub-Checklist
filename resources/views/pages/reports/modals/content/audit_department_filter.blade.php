<form id="mystore_filter_form">
    <div class="row">
        <div class="form-group col-md-12">
            <label for="checklist">Location</label>
            <select class="form-control" name="dep-loc" id="dep-loc" aria-placeholder="Choose store">
                <option></option>
                @foreach ($office as $bo)
                @php $bo->Location_ID == $location ? $selected = 'selected' : $selected = ''; @endphp
                <option value="{{ $bo->Location_ID }}" {{ $selected }}>{{ $bo->LocationCode }} - {{ $bo->Location }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-12">
            <label for="checklist">Department</label>
            <select class="form-control" name="dep-dep" id="dep-dep" aria-placeholder="Choose store">
                <option></option>
                @foreach ($department as $dep)
                @php $dep->Department_ID == $dept ? $selected = 'selected' : $selected = ''; @endphp
                <option value="{{ $dep->Department_ID }}" {{ $selected }}>{{ $dep->DepartmentCode }} - {{ $dep->Department }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-12">
            <label for="checklist">Checklist</label>
            <input name="dep-cl" id="dep-cl" type="text" class="form-control" placeholder="Title or description"
                value="{{ $checklist }}">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12">
            <label for="datestart">Date start range</label>
            <input name="dep-datestart" id="dep-datestart" type="text" class="form-control" value="{{ $datestart }}">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12">
            <label for="dateend">Date end range</label>
            <input name="dep-dateend" id="dep-dateend" type="text" class="form-control" value="{{ $dateend }}">
        </div>
    </div>
</form>