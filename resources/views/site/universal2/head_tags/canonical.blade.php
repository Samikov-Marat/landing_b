@if(!empty($languageUri))
    <link rel="canonical"
          href="{{ route('site.show_page', ['languageUrl' => $languageUri, 'pageUrl' => $page->url]) }}"
    />
@endif
@foreach($languages as $language)
    @if($params->has($language->id))
        <link rel="alternate"
              hreflang="{{ $currentLanguage->id === $language->id ? 'x-default' : $params->get($language->id) }}"
              href="{{ route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => $page->url]) }}"
        />
    @endif
@endforeach
