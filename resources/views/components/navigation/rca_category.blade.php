<ul class="ctg-parent-ul">
@foreach ($category as $parent)

    @php
    $isParent = MyHelper::checkAnswerCategoryParent($parent['AnswerChecklist_ID'], $parent['Category_ID']);
    $hasItem = MyHelper::checkAnswerCategoryItem($parent['AnswerCategory_ID']);
    $hasFindings = MyHelper::checkAnswerCategoryFindings($parent['AnswerCategory_ID']);
    $isDone = MyHelper::checkAnswerCategoryFindingsDone($parent['AnswerCategory_ID']);
    $icon = '';
    $disable = '';
    $alert = '';

    if($isParent > 0) :
        $icon = 'fa fa-minus-square';
    endif;

    if($hasItem < 1) : 
        $disable='disabled' ; 
    endif; 
    
    if($hasFindings > 0) :
        if($isDone == $hasFindings) :
            $alert = 'fas fa-check-circle text-success';
        else :
            $alert = 'fas fa-exclamation-circle text-danger';
        endif;
    endif;

    @endphp
        <li class="parent-category">
            <span class="span-{{ $parent['AnswerCategory_ID'] }}">
                <i class="toggle-tree {{ $icon }}"></i>&nbsp;
                <a class="ctg-link {{ $disable }}" data-id={{ $parent['AnswerCategory_ID'] }}>{{ $parent['CategoryName'] }}</a>
                <i class="alert-{{ $parent['AnswerCategory_ID'] }} {{ $alert }}"></i>
            </span>
            @if (!empty($parent['SubCategory']))
            {!! MyHelper::showRCASubCategory($parent['SubCategory']) !!}
            @endif
        </li>

@endforeach
</ul>