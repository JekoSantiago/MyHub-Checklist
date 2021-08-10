<form id="mystore_filter_form">
    <div class="row">
        <div class="form-group col-md-12">
            <label for="checklist">Location</label>
            <select class="form-control" name="ad-location" id="ad-location" aria-placeholder="Choose store">
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
            <select class="form-control select2-search" name="ad-department" id="ad-department" aria-placeholder="Choose store">
                <option></option>
                @foreach ($department as $dep)
                @php $dep->Department_ID == $department ? $selected = 'selected' : $selected = ''; @endphp
                <option value="{{ $dep->Department_ID }}" {{ $selected }}>{{ $dep->DepartmentCode }} - {{ $dep->Department }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-12">
            <label for="checklist">Checklist</label>
            <input name="ad-checklist" id="ad-checklist" type="text" class="form-control" placeholder="Title or description"
                value="{{ $checklist }}">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12">
            <label for="datestart">Date start range</label>
            <input name="ad-datestart" id="ad-datestart" type="text" class="form-control" value="{{ $datestart }}">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12">
            <label for="dateend">Date end range</label>
            <input name="ad-dateend" id="ad-dateend" type="text" class="form-control" value="{{ $dateend }}">
        </div>
    </div>
    <div class="custom-control custom-checkbox">
        @php $issubmit == 1 ? $checked = 'checked' : $checked = ''; @endphp
        <input class="custom-control-input" type="checkbox" name="ad-isSubmit" id="ad-isSubmit" {{ $checked }}>
        <label class="custom-control-label" for="ad-isSubmit">Submitted</label>
    </div>
</form>