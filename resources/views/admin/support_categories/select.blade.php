@foreach($tree as $node)
    @if($supportCategory->exists && $node->id == $supportCategory->id)
        @continue
    @endif
    <option value="{{ $node->id }}" {{ $parent_id == $node->id?'selected':'' }}>
        {!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level + 1) !!}{{ $node->supportCategoryTexts ? $node->supportCategoryTexts[0]->name : $node->id }}
    </option>
    @include('admin.support_categories.select', ['tree' => $node->subCategories, 'level' => $level + 1])
@endforeach
