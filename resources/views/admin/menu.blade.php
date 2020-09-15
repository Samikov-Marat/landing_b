@auth

    @php
        $menu = [
                ['route' => 'admin.sites.index', 'text' => 'Сайты', 'active' => false],
                ['route' => 'admin.pages.index', 'text' => 'Страницы', 'active' => false],
            ];
    @endphp


    <nav class="nav">

        @foreach($menu as $menuItem)
            <li>
                <a class="nav-link {{ $menuItem['active']?'active':''  }}"
                   href="{!! route($menuItem['route']) !!}">{{ $menuItem['text'] }}</a>
            </li>
        @endforeach
    </nav>

@endauth
