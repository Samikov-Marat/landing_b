@extends('site.universal2.layout')

@section('content')
    <style>
        body, .body-wrapper {
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-content: space-between;
        }

        header {
            flex-grow: 0;
        }

        .content {
            flex-grow: 2;
        }

        footer {
            flex-grow: 0;
        }
    </style>

    <div class="info-page-markdown content">
        {!! Markdown::parse($dictionary['legal_content']) !!}
    </div>
@endsection
