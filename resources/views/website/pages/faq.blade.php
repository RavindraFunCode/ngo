@extends('layouts.website')

@section('title', 'FAQ\'s || Humanity')

@section('content')
    <div class="inner-banner has-base-color-overlay text-center" style="background: url({{ asset('website/images/background/4.jpg') }});">
        <div class="container">
            <div class="box">
                <h1>FAQ's</h1>
            </div>
        </div>
    </div>
    <div class="breadcumb-wrapper">
        <div class="container">
            <div class="pull-left">
                <ul class="list-inline link-list">
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>
                        FAQ's
                    </li>
                </ul>
            </div>
            <div class="pull-right">
                <a href="{{ route('volunteer') }}" class="get-qoute"><i class="fa fa-arrow-circle-right"></i>Become a Volunteer</a>
            </div>
        </div>
    </div>

    <section class="faq-section sec-padd2">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="accordion-box style-one">
                        @foreach($faqs as $index => $faq)
                            @php
                                $translation = $faq->getTranslation(app()->getLocale()) ?? $faq->getTranslation('en');
                            @endphp
                            @if($translation)
                                <!--Start single accordion box-->
                                <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                                    <div class="acc-btn {{ $index == 0 ? 'active' : '' }}">
                                        <p class="title">{{ $translation->question }}</p>
                                        <div class="toggle-icon">
                                            <span class="plus fa fa-angle-right"></span><span class="minus fa fa-angle-down"></span>
                                        </div>
                                    </div>
                                    <div class="acc-content {{ $index == 0 ? 'collapsed' : '' }}">
                                        <div class="text"><p>
                                            {{ $translation->answer }}
                                        </p></div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="category-style-one">
                        <div class="inner-title">
                            <h4>Categories</h4>
                        </div>
                        <ul class="list">
                            <li>
                                <a href="{{ route('faq') }}" class="{{ !request('category') ? 'active' : '' }}">All Categories</a>
                            </li>
                            @foreach($categories as $category)
                                @php
                                    $translation = $category->getTranslation(app()->getLocale()) ?? $category->getTranslation('en');
                                @endphp
                                @if($translation)
                                <li>
                                    <a href="{{ route('faq', ['category' => $translation->slug]) }}" class="{{ request('category') == $translation->slug ? 'active' : '' }}">
                                        {{ $translation->name }} <span>({{ $category->faqs_count }})</span>
                                    </a>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
