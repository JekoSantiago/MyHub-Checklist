<form id="new_checklist">
    <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control" type="text" name="title" id="title" autocomplete="off">
        <label class="validation-error-label" id="newcltitleerror">Title is required.</label>
    </div>
    <div class="form-group">
        <label for="desc">Description</label>
        <input class="form-control" type="text" name="desc" id="desc" autocomplete="off">
    </div>
    <div class="form-group">
        <label for="type">Type</label>
        <select name="type" id="type" data-placeholder="Select Checklist Type" class="form-control">
            <option disabled selected>Select checklist type</option>
            @foreach ($type as $t)
                <option value="{{ $t->ChecklistType_ID }}">{{ $t->ChecklistType }}</option>    
            @endforeach
        </select>
        <label class="validation-error-label" id="newcltypeerror">Checklist type is required.</label>
    </div>
</form>