@extends('layouts.website')

@section('title', 'About Us || Humanity')

@section('content')
    <div class="inner-banner has-base-color-overlay text-center" style="background: url({{ isset($settings['about_page_bg_image']) ? (\Illuminate\Support\Str::startsWith($settings['about_page_bg_image'], 'website/') ? asset($settings['about_page_bg_image']) : asset('uploads/' . $settings['about_page_bg_image'])) : asset('website/images/background/4.jpg') }});">
        <div class="container">
            <div class="box">
                <h1>About Us</h1>
            </div>
        </div>
    </div>

    <div class="breadcumb-wrapper">
        <div class="container">
            <div class="pull-left">
                <ul class="list-inline link-list">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>About Us</li>
                </ul>
            </div>
            <div class="pull-right">
                <a class="get-qoute" href="{{ route('volunteer') }}"><i class="fa fa-arrow-circle-right"></i>Become a Volunteer</a>
            </div>
        </div>
    </div>

    <section class="about sec-padd2 style-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12 left-column">
                    <div class="row padd-bottom-30">
                        @foreach($introFeatures as $feature)
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="img-box">
                                @if($feature->image)
                                    <img src="{{ \Illuminate\Support\Str::startsWith($feature->image, 'website/') ? asset($feature->image) : asset('uploads/' . $feature->image) }}" alt="">
                                @endif
                            </div>
                            <div class="content">
                                <p>{{ $feature->description }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="content">
                        <div class="text">
                            <p>{!! nl2br(e($settings['about_page_right_text_1'] ?? '')) !!}</p>
                        </div>
                        <h3 class="thm-color">{{ $settings['about_page_right_title'] ?? 'Years of Experience' }}</h3>
                        <div class="text">
                            <p>{!! nl2br(e($settings['about_page_right_text_2'] ?? '')) !!}</p>
                        </div>
                        <ul>
                            @if(isset($settings['about_page_checklist']))
                                @foreach(explode("\n", $settings['about_page_checklist']) as $item)
                                    @if(trim($item))
                                        <li><i class="fa fa-check"></i>{{ trim($item) }}</li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="why-chooseus sec-padd-top">
        <div class="container">
            <div class="row">
                @foreach($whyChooseFeatures as $feature)
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="item">
                        <div class="inner-box">
                            <div class="icon_box"><span class="{{ $feature->icon }}"></span></div>
                            <a href="#"><h4>{{ $feature->title }}</h4></a>
                        </div>
                        <div class="text">
                            <p>{{ $feature->description }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="fact-counter fact-counter-1 sec-padd" style="background-image: url({{ isset($settings['about_page_counter_bg']) ? (\Illuminate\Support\Str::startsWith($settings['about_page_counter_bg'], 'website/') ? asset($settings['about_page_counter_bg']) : asset('uploads/' . $settings['about_page_counter_bg'])) : asset('website/images/background/5.jpg') }});">
        <div class="container">
            <div class="row clearfix">
                <div class="counter-outer clearfix">
                    @foreach($counters as $counter)
                    <article class="column counter-column col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="0ms">
                        <div class="item">
                            <div class="icon"><i class="{{ $counter->icon }}"></i></div>
                            <div class="count-outer"><span class="count-text" data-speed="3000" data-stop="{{ $counter->subtitle }}">0</span>+</div>
                            <h4 class="counter-title">{{ $counter->title }}</h4>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
