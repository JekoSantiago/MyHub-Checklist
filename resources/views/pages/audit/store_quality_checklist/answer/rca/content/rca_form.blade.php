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
            <form class="item_form">
                <fieldset>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="mb-3">{{ $q->ItemName }}</label>
                            </div>
                            <div class="form-group {{ $auditee_disabled }}">
                                <label for="pf_{{ $q->AnswerItem_ID }}">Findings</label>
                                <textarea class="form-control problems-findings" data-id="{{ $q->AnswerItem_ID }}" name="item_{{ $q->AnswerItem_ID }}" id="pf_{{ $q->AnswerItem_ID }}" rows="2" {{ $auditee_disabled }}>{{ $q->Findings }}</textarea>
                            </div>
                            <div class="form-group {{ $ac_disabled }}">
                                <label for="response_{{ $q->AnswerItem_ID }}">Response</label>
                                <textarea class="form-control response" data-id="{{ $q->AnswerItem_ID }}" name="item_{{ $q->AnswerItem_ID }}" id="response_{{ $q->AnswerItem_ID }}" rows="2" {{ $ac_disabled }}>{{ $q->Response }}</textarea>
                            </div>
                            <div class="form-group {{ $ac_disabled }}">
                                <label for="at_{{ $q->AnswerItem_ID }}">Action Taken</label>
                                <textarea class="form-control action-taken" data-id="{{ $q->AnswerItem_ID }}" name="item_{{ $q->AnswerItem_ID }}" id="at_{{ $q->AnswerItem_ID }}" rows="2" {{ $ac_disabled }}>{{ $q->Action }}</textarea>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
            <form id="dropzone_{{ $q->AnswerItem_ID }}" action="{{ url('/answer/item/file-upload/'. $q->AnswerItem_ID) }}" data-id="{{ $q->AnswerItem_ID }}" class="dropzone dz-clickable {{ $auditee_disabled }}">
                @csrf
                <input type="hidden" name="ai_ID" id="ai_ID" value="{{ $q->AnswerItem_ID }}">
                <div class="dz-default dz-message">
                    <button class="dz-button" type="button">Drop images here or click to upload.</button>
                    <span>Maximum of 5 images only.</span>
                </div>
            </form>
        </div>
    </div>
    @endforeach
</div>

<ul class="pager">
    @foreach ($navigation as $nav)
    @if ($category[0]->AnswerCategory_ID == $nav->CurrCtg_ID)
    @if ($nav->Previous != 0)
    <li data-id="{{ $nav->Previous }}" class="previous btn btn-sm bg-cl waves-effect waves-light"><a
            href="#">Previous</a></li>
    @endif
    @if ($nav->Next != 0)
    <li data-id="{{ $nav->Next }}" class="next btn btn-sm bg-cl waves-effect waves-light"><a href="#">Next</a></li>
    @endif
    @endif
    @endforeach
</ul>