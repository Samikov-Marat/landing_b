@php
    $menu = [
            ['route' => 'admin.index', 'text' => 'Сайты', 'active' => false],
        ];
@endphp
<nav class="nav flex-column">

    @foreach($menu as $menuItem)
        <li>
            <a class="nav-link {{ $menuItem['active']?'active':''  }}"
               href="{!! route($menuItem['route']) !!}">{{ $menuItem['text'] }}</a>
        </li>
    @endforeach
</nav>
