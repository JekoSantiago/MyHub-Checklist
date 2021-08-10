<ul class="ctg-parent-ul">
    @foreach ($category as $parent)
        @php 
            $isParent = MyHelper::checkAnswerCategoryParent($parent['AnswerChecklist_ID'], $parent['Category_ID']);
            $hasItem = MyHelper::checkAnswerCategoryItem($parent['AnswerCategory_ID']);
            $isDone = MyHelper::checkAnswerCategoryRequiredItemsDone($parent['AnswerChecklist_ID'], $parent['AnswerCategory_ID']);
            $icon = ''; 
            $disable = '';
            $done = '';

            if($isParent > 0) :
                $icon = 'fa fa-minus-square';
            endif;

            if($hasItem < 1) :
                $disable = 'disabled';
            else :
                if($isDone == 0) :
                    $done = 'required-items-done';
                endif;
            endif;
        @endphp
        <li class="parent-category"><span class="span-{{ $parent['AnswerCategory_ID'] }} {{ $done }}"><i class="toggle-tree {{ $icon }}"></i>&nbsp;<a class="ctg-link {{ $disable }}" data-id={{ $parent['AnswerCategory_ID'] }}>{{ $parent['CategoryName'] }}</a></span>
            @if (!empty($parent['SubCategory']))
                {!! MyHelper::showAnswerSubCategory($parent['SubCategory']) !!}
            @endif
        </li> 
    @endforeach
</ul>