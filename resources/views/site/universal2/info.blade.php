@extends('site.universal2.layout')

@section('content')
    <div class="info-page content">
        {!! Markdown::parse($dictionary['info_content']) !!}
    </div>
@endsection
