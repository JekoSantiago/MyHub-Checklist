<div class="card answer-category-card">
    <div class="card-body">
        <div class="answer-category-info">
            <h4>{{ $category[0]->CategoryName }}</h4>
        </div>
    </div>
</div>
<div class="answer-questions-container">
    @foreach ($questions as $q)
    <div data-id="{{ $q->AnswerItem_ID }}" class="card">
        <div class="card-body">
            <form class="item_form mb-3">
                <fieldset>
                    <div class="row">
                        <div class="col-md-12">
                            @if ($q->isRequired == 1)
                            <label for="inp_{{ $q->AnswerItem_ID }}">{{ $q->ItemName }}<span style="color: red;">*</span></label>    
                            @else
                            <label for="inp_{{ $q->AnswerItem_ID }}">{{ $q->ItemName }}</label>    
                            @endif
                            
                            <div class="form-group">
                                @switch($q->ItemType_ID)
                                @case(1)
                                <div class="custom-input">
                                    <input class="form-control" type="text" placeholder="Your answer"
                                        data-id="{{ $q->AnswerItem_ID }}" value="{{ $q->Answer }}">
                                </div>
                                @break
                                @case(2)
                                <div class="custom-input">
                                    <textarea class="form-control" placeholder="Your answer"
                                        data-id="{{ $q->AnswerItem_ID }}" rows="2">{{ $q->Answer }}</textarea>
                                </div>
                                @break
                                @case(3)
                                @foreach ($option as $o)
                                @if ($q->AnswerItem_ID == $o->AnswerItem_ID)
                                @php $o->isSelected == 1 ? $checked = 'checked' : $checked = ''; @endphp
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" data-id="{{ $q->AnswerItem_ID }}" type="radio"
                                        name="item_{{ $q->AnswerItem_ID }}" id="option_{{ $o->AnswerOption_ID }}"
                                        value="{{ $o->AnswerOption_ID }}" {{ $checked }}>
                                    <label class="custom-control-label" data-id="{{ $q->AnswerItem_ID }}"
                                        for="option_{{ $o->AnswerOption_ID }}">{{ $o->OptionName }}</label>
                                </div>
                                @endif
                                @endforeach
                                @break
                                @case(4)
                                @foreach ($option as $o)
                                @if ($q->AnswerItem_ID == $o->AnswerItem_ID)
                                @php $o->isSelected == 1 ? $checked = 'checked' : $checked = ''; @endphp
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" data-id="{{ $q->AnswerItem_ID }}"
                                        type="checkbox" name="item_{{ $q->AnswerItem_ID }}"
                                        id="option_{{ $o->AnswerOption_ID }}" value="{{ $o->AnswerOption_ID }}"
                                        {{ $checked }}>
                                    <label class="custom-control-label" data-id="{{ $q->AnswerItem_ID }}"
                                        for="option_{{ $o->AnswerOption_ID }}">{{ $o->OptionName }}</label>
                                </div>
                                @endif
                                @endforeach
                                @break
                                @case(5)
                                <select placeholder="Choose your answer" data-id="{{ $q->AnswerItem_ID }}"
                                    class="form-control answer-select">
                                    @foreach ($option as $o)
                                    @if ($q->AnswerItem_ID == $o->AnswerItem_ID)
                                    @php $o->isSelected == 1 ? $selected = 'selected' : $selected = ''; @endphp
                                    <option value="{{ $o->AnswerOption_ID }}" {{ $selected }}>{{ $o->OptionName }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                                @break
                                @case(6)
                                <div class="input-group row col-md-5">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroup" multiple>
                                        <label class="custom-file-label" for="inputGroup">Choose file</label>
                                    </div>
                                </div>
                                @break
                                @case(7)
                                <div class="input-group row col-md-5">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    <div class="custom-input">
                                        <input type="text" class="form-control input-date"
                                            data-id="{{ $q->AnswerItem_ID }}" placeholder="Date"
                                            value="{{ $q->Answer }}">
                                    </div>
                                </div>
                                @break
                                @default
                                <div class="input-group row col-md-5">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-clock-o"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    <div class="custom-input">
                                        <input type="text" class="form-control input-time"
                                            data-id="{{ $q->AnswerItem_ID }}" placeholder="Time"
                                            value="{{ $q->Answer }}">
                                    </div>
                                </div>
                                @endswitch
                            </div>
                        </div>
                    </div>
                    <div class="remarks-container">
                        <input class="form-control" type="text" placeholder="Other remarks..."
                            data-id="{{ $q->AnswerItem_ID }}" value="<?= $q->OtherRemarks; ?>">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    @endforeach
</div>

<ul class="pager">
    @foreach ($navigation as $nav)
    @if ($category[0]->AnswerCategory_ID == $nav->CurrCtg_ID)
    @if ($nav->Previous != 0)
    <li data-id="{{ $nav->Previous }}" class="previous btn btn-sm btn-custom bg-cl waves-effect waves-light"><a
            href="#">Previous</a></li>
    @endif
    @if ($nav->Next != 0)
    <li data-id="{{ $nav->Next }}" class="next btn btn-sm btn-custom bg-cl waves-effect waves-light"><a href="#">Next</a></li>
    @endif
    @endif
    @endforeach
</ul>