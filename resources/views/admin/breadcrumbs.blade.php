<ol class="breadcrumb float-sm-right">
    @foreach($breadcrumbs as $item)
        @if(isset($item['href']))
            <li class="breadcrumb-item"><a href="{!! $item['href'] !!}">{{ $item['text'] }}</a></li>
        @else
            <li class="breadcrumb-item active">{{ $item['text'] }}</li>
        @endif
    @endforeach
</ol>
