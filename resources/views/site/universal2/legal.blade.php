@extends('site.universal2.layout')

@section('content')
    <div class="info-page-markdown content">
        {!! Markdown::parse($dictionary['legal_content']) !!}
    </div>
@endsection
