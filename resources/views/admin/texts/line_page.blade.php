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

    <tr class="js-admin-texts-line-page" data-url="{!! route('admin.texts.edit', ['site_id' => $site->id, 'text_type_id' => $textType->id]) !!}">
        @foreach($languages as $language)
            <td>
                @if($textsByLanguage->has($language->id))
                    {!! nl2br(e($textsByLanguage->get($language->id)->value)) !!}
                @endif
            </td>
        @endforeach
    </tr>
@endforeach

