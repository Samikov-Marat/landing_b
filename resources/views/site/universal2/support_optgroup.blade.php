<option>{!! str_repeat('&nbsp;&nbsp;&nbsp;', $level) !!}{{ $category->supportCategoryTexts[0]->name }}</option>


@foreach($category->subCategories as $subCategory)
    @include('site.universal2.support_optgroup', ['category' => $subCategory, 'level' => $level + 1])
@endforeach

@foreach($category->supportQuestions as $question)
    <option>{!! str_repeat('&nbsp;&nbsp;&nbsp;', $level + 1) !!}{{ $question->supportQuestionTexts[0]->question }}</option>
@endforeach
