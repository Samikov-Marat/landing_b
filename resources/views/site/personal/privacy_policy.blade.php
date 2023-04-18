@extends('site.personal.layout')


@section('seo_title', $dictionary['personal_privacy_policy_seo_title'])
@section('seo_description', $dictionary['personal_privacy_policy_seo_description'])

@section('content')

            <div class="info-page-markdown content">
                {!! Markdown::parse($dictionary['privacy_policy_content']) !!}
            </div>

@endsection
