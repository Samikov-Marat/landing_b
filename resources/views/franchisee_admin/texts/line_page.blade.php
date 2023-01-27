<tr>
    <th colspan="{{ $languages->count() + 1 }}">
        <span class="text-primary">{{ $page->url }}</span>
        {{ $page->name }}
    </th>
</tr>
@foreach($page->textTypes as $textType)
    @php
        $textsByLanguage = $textType->texts->keyBy('language_id');
        $franchiseeTextsByLanguage = $textType->franchiseeTexts->keyBy('language_id');
    @endphp

    <tr>
        @foreach($languages as $language)
            @php
                if($franchiseeTextsByLanguage->has($language->id)){
                    $value = $franchiseeTextsByLanguage->get($language->id)->value;
                }
                elseif($textsByLanguage->has($language->id)){
                    $value = $textsByLanguage->get($language->id)->value;
                }
                else{
                    $value = '';
                }

            @endphp

                @if($textsByLanguage->has($language->id))
                    <td>
                        {!! nl2br(e($value)) !!}
                    </td>
                @else
                    <td>
                    </td>
                @endif
        @endforeach
        <td>
            <a href="{{ route('admin.franchisee_admin.texts.edit', ['site_id' => $site->id, 'text_type_id' => $textType->id]) }}" class="btn btn-primary">Редактировать</a>

        </td>
    </tr>
@endforeach

