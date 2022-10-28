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

    <div class="content">
        <h2 class="typo-h2">@d('contractdocs_header')</h2>
        <div class="info-page-markdown">
            {!! Markdown::parse($dictionary['contractdocs_content']) !!}
        </div>
    </div>
@endsection
