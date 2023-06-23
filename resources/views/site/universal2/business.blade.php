@extends('site.universal2.layout')

@section('content')

    <div class="business-page">

        @include('site.universal2.business_poster_block')

        @if(isset($dictionary['advantages_header_1']))
            @include('site.universal2.international_express_block')
        @endif


        <div class="calculator-neutral-bg">
        @include('site.universal2.calculator_block', ['customer_type' => 'UR', 'receiver_type' => 'UR'])
        </div>
        @include('site.universal2.order_block', ['orderFormType' => 'business_order'])

        @include('site.universal2.how_it_works_block')

        @include('site.universal2.package_russia_block')

        @include('site.universal2.faq_block')

        @include('site.universal2.partners_block')

        @include('site.universal2.any_questions_block')

    </div>

@endsection
