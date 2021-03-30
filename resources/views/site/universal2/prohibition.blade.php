@extends('site.universal2.layout')

@section('content')
    <div class="prohibition-page">
        <div class="prohibition screen-content">
            <h1 class="typo-h1">@d('prohibition_header_international_express')</h1>
            <div>
                {!! Markdown::parse($dictionary['prohibition_content_international_express']) !!}
            </div>
            @d('prohibition_also')
            <h2 class="typo-h2 mt0">@d('prohibition_header_not_implemented')</h2>
            <div>
                @d('prohibition_content_not_implemented')
            </div>
            <h2 class="typo-h2">@d('prohibition_header_limitations')</h2>
            <div>
                @d('prohibition_content_limitations')
            </div>
            <h2 class="typo-h2">@d('prohibition_header_import')</h2>
            <div>
                @d('prohibition_content_import')
            </div>
            <div>
                @d('prohibition_content_medications')
                <div style="color: red;">
                    @d('prohibition_content_red')
                </div>
                @d('prohibition_content_custom')
            </div>
            <h2 class="typo-h2">@d('prohibition_header_cdek_express')</h2>
            <div>
                {!! Markdown::parse($dictionary['prohibition_content_cdek_express']) !!}
            </div>
        </div>

    </div>

@endsection
