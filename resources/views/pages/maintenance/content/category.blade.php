<ul class="ctg-parent-ul">
    @foreach ($category as $parent)
    @php
    $isParent = MyHelper::checkCategoryParent($parent['Category_ID']);
    $icon = '';

    if($isParent > 0) :
    $icon = 'fa fa-minus-square';
    endif;
    @endphp
    <li class="parent-category">
        <span class="span-{{ $parent['Category_ID'] }}">
            <i class="toggle-tree {{ $icon }}"></i>
            <a class="ctg-link" data-id={{ $parent['Category_ID'] }}>{{ $parent['CategoryName'] }}</a>
        </span>
        <div class="category-action-menu">
            <a href="#" class="add-subcategory waves-effect waves-light" title="Add Subcategory" data-placement="top"
                data-id="{{ $parent['Category_ID'] }}" data-toggle="modal" data-target="#modal_newcategory"><i
                    class="fa fa-plus" aria-hidden="true"></i></a>
            <a href="#" class="remove-category waves-effect waves-light" title="Remove Category" data-placement="top"
                data-id="{{ $parent['Category_ID'] }}"><i class="fa fa-minus" aria-hidden="true"></i></a>
            {{-- <a href="#" class="arrange-category waves-effect waves-light" title="Arrange Subcategories"
                data-placement="top" data-id="{{ $parent['Category_ID'] }}"><i class="fa fa-random"
                    aria-hidden="true"></i></a> --}}
        </div>
        @if (!empty($parent['SubCategory']))
        {!! MyHelper::showSubCategory($parent['SubCategory']) !!}
        @endif
    </li>
    @endforeach
</ul>