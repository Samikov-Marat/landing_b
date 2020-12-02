<tr>
    <th colspan="{{ $languages->count() }}">
        {{ $page->name }}
        {{ $page->url }}
    </th>
</tr>
@foreach($page->textTypes as $textType)
    @php
        $textsByLanguage = $textType->texts->keyBy('language_id');
    @endphp

    <tr class="js-admin-texts-line-page js-admin-texts-line-for-filter" data-url="{!! route('admin.texts.edit', ['site_id' => $site->id, 'text_type_id' => $textType->id]) !!}">
        @foreach($languages as $language)
                @if($textsByLanguage->has($language->id))
                    <td class="js-admin-texts-td-for-filter" data-text="{{ $textsByLanguage->get($language->id)->value }}">
                        {!! nl2br(e($textsByLanguage->get($language->id)->value)) !!}
                    </td>
                @else
                    <td>
                    </td>
                @endif
        @endforeach
    </tr>
@endforeach

