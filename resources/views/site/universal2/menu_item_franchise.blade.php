<li class="main-menu__item">
    @if (isset($dictionary['menu_franchise_link']) && $dictionary['menu_franchise_link'])
        <a class="main-menu__link" href="{!! $dictionary['menu_franchise_link'] !!}" target="_blank">
            {{ $dictionary['menu_franchise'] }}
        </a>
    @else
        <a class="main-menu__link" href="{!! route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'franchise']) !!}">
            {{ $dictionary['menu_franchise'] }}
        </a>
    @endif
</li>
