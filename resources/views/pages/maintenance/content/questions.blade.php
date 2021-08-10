@if (count($category) > 0)
<div class="card card-custom card-click">
    <div class="card-header">
        <h5 class="card-title">Category</h5>
    </div>
    <div class="card-body">
        <form id="edit_category_form">
            <div class="row">
                <div class="form-group col-md-10">
                    <input class="form-control" type="text" name="categoryName" id="categoryName" autocomplete="off"
                        value="{{ $category[0]->CategoryName }}">
                </div>
                <div class="form-group input-group col-md-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></i></span>
                    </div>
                    <input type="text" class="form-control ctg-portion-input" name="categoryPortion"
                        id="categoryPortion" placeholder="Portion" value="{{ number_format($category[0]->Portion,2) }}">
                </div>
            </div>
            <input type="hidden" name="active_ctg" id="active_ctg" value="{{ $category[0]->Category_ID }}">
        </form>
    </div>
</div>
<div class="questions-container">
    @foreach ($question as $q)
    <div data-id="{{ $q->Item_ID }}" class="card card-custom card-click card-{{ $q->Item_ID }}">
        <div class="card-body">
            <form class="item_form">
                <div class="row">
                    <div class="form-group col-md-7">
                        {{-- <label class="label-question">Question</label> --}}
                        <input class="form-control item-input" autocomplete="off" data-id="{{ $q->Item_ID }}"
                            type="text" name="quest_{{ $q->Item_ID }}" id="quest_{{ $q->Item_ID }}"
                            value="{{ $q->ItemName }}">
                    </div>
                    <div class="form-group col-md-3 select-type">
                        {{-- <label class="label-question">Type</label> --}}
                        <select data-id="{{ $q->Item_ID }}" name="type_{{ $q->Item_ID }}" id="type_{{ $q->Item_ID }}"
                            class="form-control">
                            @foreach ($type as $qt)

                            @php $select = ($qt->ItemType_ID == $q->ItemType_ID) ? 'selected=selected' : ''; @endphp

                            <option value="{{ $qt->ItemType_ID }}" {{ $select }}>{{ $qt->TypeName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group input-group col-md-2 item-portion">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></i></span>
                        </div>
                        <input data-id="{{ $q->Item_ID }}" type="text" class="form-control item-portion-input"
                            placeholder="Portion" value="{{ number_format($q->Portion,2) }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <input class="form-control form-control-sm input-description" data-id="{{ $q->Item_ID }}"
                            type="text" autocomplete="off" name="desc_{{ $q->Item_ID }}" id="desc_{{ $q->Item_ID }}"
                            placeholder="Question description..." value="{{ $q->ItemDescription }}">
                    </div>
                </div>
            </form>
            @if ( in_array($q->ItemType_ID, config('app.group_type')) )
            <div class="options">
                @php $count = 1; @endphp
                @php $counter = 1; @endphp
                @php $visible = 'invisible'; @endphp
                @foreach ($option as $opt)
                @if ($q->Item_ID == $opt->Item_ID )
                <div class="row form-group">
                    <div class="col-md-8 option-length">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                @switch($q->ItemType_ID)
                                @case(3)
                                @php $icon = '<i class="far fa-circle" aria-hidden="true"></i>'; @endphp
                                @break
                                @case(4)
                                @php $icon = '<i class="far fa-square" aria-hidden="true"></i>'; @endphp
                                @break
                                @default
                                @php $icon = $count . '.'; @endphp
                                @endswitch
                                <span class="input-group-text type-icon">{!! $icon !!}</span>
                            </div>
                            <input class="form-control option_name" data-id="{{ $opt->ItemOption_ID }}" type="text"
                                name="opt_name" id="option_{{ $opt->ItemOption_ID }}" value="{{ $opt->OptionName }}">
                        </div>
                    </div>
                    <div class="col-rate">
                        <input class="form-control option_rate" data-id="{{ $opt->ItemOption_ID }}" type="text"
                            name="opt_rate" id="rate_{{ $opt->ItemOption_ID }}"
                            value="{{ number_format($opt->Rate, 3) }}">
                    </div>
                    <div class="col-rate">
                        <input class="form-control option_ratecode" data-id="{{ $opt->ItemOption_ID }}" type="text"
                            name="opt_ratecode" id="ratecode_{{ $opt->ItemOption_ID }}"
                            value="{{ $opt->RateCode }}">
                    </div>
                    @if ($counter++ != 1 )
                        @php $visible = ''; @endphp
                    @endif
                    <div class="action-remove">
                        <a data-id="{{ $opt->ItemOption_ID }}" data-item="{{ $q->Item_ID }}"
                            class="btn-action btn-sm waves-effect waves-light opt_remove {{ $opt->ItemOption_ID != config('app.expired_item_option_ID') ? $visible : 'invisible' }}"><i
                                class="fa fa-times" data-toggle="tooltip" title="Remove" data-placement="right" ></i></a>
                    </div>
                </div>
                @php $count++; @endphp
                @endif

                @endforeach
            </div>
            <div class="add-option">
                <div class="row form-group">
                    <div class="col-md-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                @switch($q->ItemType_ID)
                                @case(3)
                                @php $icon = '<i class="far fa-circle" aria-hidden="true"></i>'; @endphp
                                @break
                                @case(4)
                                @php $icon = '<i class="far fa-square" aria-hidden="true"></i>'; @endphp
                                @break
                                @default
                                @php $icon = $count . '.'; @endphp
                                @endswitch
                                <span class="input-group-text type-icon">{!! $icon !!}</span>
                            </div>
                            <input class="form-control addOption" data-id="{{ $q->Item_ID }}"
                                placeholder="Add option..." type="text" name="addOption" readonly>
                        </div>
                    </div>
                </div>
            </div>
            @else
            @switch($q->ItemType_ID)
            @case(1)
            <div class="row">
                <div class="col-md-5">
                    <input type="text" class="form-control" placeholder="Short Answer Text" disabled>
                </div>
            </div>
            @break
            @case(2)
            <div class="row">
                <div class="col-md-6">
                    <textarea class="form-control" placeholder="Paragraph Text" rows="2" disabled></textarea>
                </div>
            </div>
            @break
            @case(6)
            <div class="input-group row col-md-5">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroup" disabled>
                    <label class="custom-file-label" for="inputGroup">Choose file</label>
                </div>
            </div>
            @break
            @case(7)
            <div class="input-group row col-md-5">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar-alt" aria-hidden="true"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Date" disabled>
            </div>
            @break
            @default
            <div class="input-group row col-md-5">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-clock" aria-hidden="true"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Time" disabled>
            </div>
            @endswitch
            @endif
        </div>
        <div class="card-footer">
            <div class="float-right footer-actions">
                @if( $q->Item_ID != config('app.expired_item_ID'))
                <a data-id="{{ $q->Item_ID }}" data-toggle="tooltip" title="Duplicate" data-placement="right" class="btn-action btn-md waves-effect waves-light duplicate_item"><i
                        class="fas fa-clone"></i></a>
                <a data-id="{{ $q->Item_ID }}" data-toggle="tooltip" title="Remove" data-placement="right" class="btn-action btn-md waves-effect waves-light remove_item"><i
                        class="fas fa-trash-alt"></i></a>
                <div class="action-divider"></div>
                <div class="custom-control custom-switch">
                    @php
                    if($q->isRequired == 1) :
                    $checked = 'checked';
                    else :
                    $checked = '';
                    endif;
                    @endphp
                    <input data-id="{{ $q->Item_ID }}" type="checkbox" class="custom-control-input require-switch"
                        id="required_{{ $q->Item_ID }}" {{ $checked }}>
                    <label class="custom-control-label" for="required_{{ $q->Item_ID }}">Required</label>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif