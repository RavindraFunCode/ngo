@extends('layouts.website')

@section('title', 'Home || Humanity')

@section('content')
    <!--Start rev slider wrapper-->
    <section class="rev_slider_wrapper">
        <div class="rev_slider" data-version="5.0" id="slider1">
            <ul>
                @foreach($sliders as $slider)
                <li data-transition="fade">
                    <img alt="" data-bgfit="cover" data-bgparallax="1" data-bgposition="top center" data-bgrepeat="no-repeat" height="888" src="{{ asset('uploads/' . $slider->image) }}" width="1920">
                    <div class="tp-caption tp-resizeme" data-hoffset="15" data-mask_in="x:[100%];y:0;s:inherit;e:inherit;" data-responsive_offset="on" data-splitin="none" data-splitout="none" data-start="700" data-transform_idle="o:1;" data-transform_in="x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;" data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-voffset="350" data-x="left" data-y="top">
                        <div class="slide-content-box">
                            <h1>{!! $slider->title !!}</h1>
                            <p>{!! $slider->subtitle !!}</p>
                        </div>
                    </div>
                    <div class="tp-caption tp-resizeme" data-hoffset="15" data-responsive_offset="on" data-splitin="none" data-splitout="none" data-start="2300" data-transform_idle="o:1;" data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-voffset="580" data-x="left" data-y="top">
                        <div class="slide-content-box">
                            <div class="button">
                                <a class="thm-btn" href="{{ $slider->button_link }}">{{ $slider->button_text }}</a>
                            </div>
                        </div>
                    </div>-
                </li>
                @endforeach
            </ul>
        </div>
    </section>
    <!--End rev slider wrapper-->

    @if($features->count() > 0)
    <section class="about-2 sec-padd3">
        <div class="container">
            <div class="section-title center">
                <h2>{!! $settings['welcome_title'] ?? 'Welcome to <span class="thm-color">Humanity</span>' !!}</h2>
                <p>{!! $settings['welcome_text'] ?? 'We are humanity/ non-profit/ fundraising/ NGO organizations...' !!}</p>
            </div>
            <div class="row">
                @foreach($features as $feature)
                <article class="col-md-4 col-sm-6 col-xs-12">
                    <div class="single-item">
                        <div class="img-box"><img alt="{{ $feature->title }}" src="{{ $feature->image ? asset('uploads/' . $feature->image) : asset('website/images/resource/about1.jpg') }}"></div>
                        <div class="content">
                            <div class="clearfix">
                                <div class="icon_box">
                                    <span class="{{ $feature->icon ?? 'icon-people' }}"></span>
                                </div>
                                <div class="text">
                                    <h4>{{ $feature->title }}</h4>
                                    <p>{{ $feature->subtitle }}</p>
                                </div>
                            </div>
                            <p>{{ $feature->description }}</p>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if($urgentCause)
    <section class="urgent-cause2 with-bg sec-padd3">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-8 col-xs-12">
                    <div class="section-title">
                        <h2>Urgent <span class="thm-color">Cause</span></h2>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="link float_right">
                        <a class="thm-btn style-2" href="{{ route('campaigns.index') }}">All Causes</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <article class="item col-md-4 col-sm-6 col-xs-12">
                    <figure class="img-box">
                        <img alt="{{ $urgentCause->title }}" src="{{ $urgentCause->image_url }}">
                        <div class="overlay">
                            <div class="inner-box">
                                <div class="content-box">
                                    <button class="thm-btn style-2 donate-box-btn" data-campaign-id="{{ $urgentCause->id }}">donate now</button>
                                </div>
                            </div>
                        </div>
                    </figure>
                    <div class="content">
                        <div class="text center">
                            <a href="{{ route('campaigns.show', $urgentCause->slug) }}">
                            <h4 class="title">{{ $urgentCause->title }}</h4></a>
                            <p>{{ Str::limit($urgentCause->description, 100) }}</p>
                        </div>
                        <div class="progress-box">
                            <div class="bar">
                                <div class="bar-inner animated-bar" data-percent="{{ $urgentCause->percentage_raised }}%">
                                    <div class="count-text">
                                        {{ $urgentCause->percentage_raised }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="donate clearfix">
                            <div class="donate float_left">
                                <span>Goal: ${{ number_format($urgentCause->goal_amount, 2) }}</span>
                            </div>
                            <div class="donate float_right">
                                Raised: ${{ number_format($urgentCause->raised_amount, 2) }}
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
    @endif

    <section class="about sec-padd2">
        <div class="container">
            <div class="section-title center">
                <h2>About our <span class="thm-color">humanity</span></h2>
            </div>
            <div class="row">
                <article class="col-md-6 col-sm-12 left-column">
                    <div class="row padd-bottom-30">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="img-box"><img alt="" src="{{ asset('website/images/resource/about4.jpg') }}"></div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <h3>What We Do</h3>
                            <p>Idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actually teachings of the great explorer of the truth.</p>
                        </div>
                    </div>
                    <div class="row padd-bottom-30">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="img-box"><img alt="" src="{{ asset('website/images/resource/about5.jpg') }}"></div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <h3>How It Works</h3>
                            <p>Idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actually teachings of the great explorer of the truth.</p>
                        </div>
                    </div>
                </article>
                <article class="col-md-6 col-sm-6 col-xs-12">
                    <div class="content">
                        <div class="text">
                            <p>Denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actually teachings of the great explorer of the truth. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.</p>
                        </div>
                        <h3 class="thm-color">Years of Experience</h3>
                        <div class="text">
                            <p>Denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actually teachings of the great explorer of the truth.</p>
                        </div>
                        <ul>
                            <li><i class="fa fa-check"></i>Excepteur sint occaecat cupidatat non proident</li>
                            <li><i class="fa fa-check"></i>Sunt in culpa qui officia deserunt mollit anim id est laborum</li>
                            <li><i class="fa fa-check"></i>Duis aute irure dolor in reprehenderit in voluptate velit esse</li>
                        </ul>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- Fact Counter -->
    <section class="fact-counter-section" style="background-image: url('{{ asset('website/images/background/5.jpg') }}');">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="counter-item">
                        <div class="icon">
                            <i class="flaticon-volunteer"></i>
                        </div>
                        <div class="content">
                            <h2 class="count">{{ $settings['count_team'] ?? '50' }}</h2>
                            <span>Team Members</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="counter-item">
                        <div class="icon">
                            <i class="flaticon-trophy"></i>
                        </div>
                        <div class="content">
                            <h2 class="count">{{ $settings['count_awards'] ?? '12' }}</h2>
                            <span>Winning Awards</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="counter-item">
                        <div class="icon">
                            <i class="flaticon-solidarity"></i>
                        </div>
                        <div class="content">
                            <h2 class="count">{{ $settings['count_experienced'] ?? '10' }}</h2>
                            <span>Experienced</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="counter-item">
                        <div class="icon">
                            <i class="flaticon-help"></i>
                        </div>
                        <div class="content">
                            <h2 class="count">{{ $settings['count_projects'] ?? '150' }}</h2>
                            <span>Project Done</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery-section pt-120 pb-120">
        <div class="container">
            <div class="section-title text-center mb-50">
                <span class="sub-title">Our Gallery</span>
                <h2 class="title">Our Photo Gallery</h2>
            </div>
            <div class="row">
                @foreach($gallery as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item">
                        <div class="gallery-img">
                            <img src="{{ asset('uploads/' . $item->image) }}" alt="{{ $item->title }}">
                            <div class="gallery-overlay">
                                <a href="{{ asset('uploads/' . $item->image) }}" class="img-popup"><i class="fal fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section pt-120 pb-120">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-image-wrap">
                        <div class="about-image-1">
                            <img src="{{ asset($settings['home_about_image_1'] ?? 'website/images/resource/about1.jpg') }}" alt="About">
                        </div>
                        <div class="about-image-2">
                            <img src="{{ asset($settings['home_about_image_2'] ?? 'website/images/resource/about2.jpg') }}" alt="About">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content">
                        <div class="section-title">
                            <span class="sub-title">About Us</span>
                            <h2 class="title">{{ $settings['home_about_title'] ?? 'About Our Humanity' }}</h2>
                        </div>
                        <p>{{ $settings['home_about_text'] ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' }}</p>
                        <a href="{{ route('about') }}" class="main-btn">Learn More <i class="fal fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="gallery-section full-width">
        <div class="container">
            <div class="section-title center">
                <h2>Our <span class="thm-color">Gallery</span></h2>
            </div>
            <div class="filter-list clearfix">
                <div class="filter-box clearfix">
                    <ul class="filter-tabs filter-btns clearfix">
                        <li class="filter active" data-role="button" data-filter="all"><span class="txt">All</span></li>
                        <li class="filter" data-role="button" data-filter=".child"><span class="txt">Child</span></li>
                        <li class="filter" data-role="button" data-filter=".charity"><span class="txt">Charity</span></li>
                        <li class="filter" data-role="button" data-filter=".sponsorship"><span class="txt">Sponsorship</span></li>
                        <li class="filter" data-role="button" data-filter=".volunteering"><span class="txt">Volunteering</span></li>
                    </ul>
                </div>
            </div>
            <div class="filter-list-container">
                <div class="col-md-3 col-sm-6 col-xs-12 mix mix_all default-item child">
                    <div class="inner-box">
                        <div class="img-box">
                            <img alt="" src="{{ asset('website/images/project/1.jpg') }}">
                            <div class="overlay">
                                <div class="box">
                                    <div class="content">
                                        <a class="img-popup" href="{{ asset('website/images/project/1.jpg') }}"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add more gallery items here as needed -->
            </div>
        </div>
    </section>

    <section class="team-style-1 sec-padd2">
        <div class="container">
            <div class="section-title center">
                <h2>Meet Our <span class="thm-color">Team</span></h2>
            </div>
            <div class="row">
                @foreach($team as $member)
                <article class="col-md-3 col-sm-6 col-xs-12">
                    <div class="single-team-member">
                        <figure class="img-box">
                            <a href="#"><img alt="{{ $member->name }}" src="{{ asset('uploads/' . $member->image) }}"></a>
                            <div class="overlay">
                                <div class="inner-box">
                                    <ul class="social">
                                        @if($member->social_links)
                                            @foreach($member->social_links as $platform => $link)
                                            <li><a href="{{ $link }}"><i class="fa fa-{{ $platform }}"></i></a></li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </figure>
                        <div class="author-info">
                            <a href="#"><h4>{{ $member->name }}</h4></a>
                            <p>{{ $member->role }}</p>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="testimonial-section-one sec-padd" style="background-image: url({{ asset('website/images/background/5.jpg') }});">
        <div class="container">
            <div class="section-title center">
                <h2>Testimonials</h2>
            </div>
            <div class="testimonial-carousel">
                @foreach($testimonials as $testimonial)
                <article class="single-testimonial-item center">
                    <figure class="img-box">
                        <a href="#"><img alt="{{ $testimonial->name }}" src="{{ asset('uploads/' . $testimonial->image) }}"></a>
                    </figure>
                    <div class="content">
                        <div class="text">
                            <p>“ {{ $testimonial->content }} ”</p>
                        </div>
                        <div class="author-info">
                            <h4>{{ $testimonial->name }}</h4>
                            <p>{{ $testimonial->role }}</p>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="blog-section sec-padd2">
        <div class="container">
            <div class="section-title center">
                <h2>Latest <span class="thm-color">News</span></h2>
            </div>
            <div class="row">
                @foreach($latestPosts as $post)
                <article class="col-md-4 col-sm-6 col-xs-12">
                    <div class="default-blog-news">
                        <figure class="img-holder">
                            <a href="{{ route('blog.show', $post->slug) }}"><img alt="{{ $post->title }}" src="{{ $post->image_url }}"></a>
                            <div class="inner-box"></div>
                        </figure>
                        <div class="overlay">
                            <div class="bottom-box">
                                <div class="category">
                                    {{ $post->category->name ?? 'Uncategorized' }}
                                </div>
                                <div class="content">
                                    <div class="post-meta">
                                        {{ $post->created_at->format('F d, Y') }} | <a href="#">0 Comments</a>
                                    </div>
                                    <a href="{{ route('blog.show', $post->slug) }}">
                                    <h4>{{ $post->title }}</h4></a>
                                    <div class="text">
                                        <p>{{ Str::limit(strip_tags($post->content), 100) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="brand-logo-sec">
        <div class="container">
            <ul class="brand-logo-carousel owl-carousel owl-theme">
                @foreach($partners as $partner)
                <li class="item">
                    <a href="{{ $partner->url ?? '#' }}"><img alt="{{ $partner->name }}" src="{{ asset('uploads/' . $partner->logo) }}"></a>
                </li>
                @endforeach
            </ul>
        </div>
    </section>

    <section class="call-out">
        <div class="container">
            <div class="float_left">
                <h4>{{ $settings['home_cta_text'] ?? 'Join Our Mission to Improve a Child\'s Life, Pet’s Life and Our Planet.' }}</h4>
            </div>
            <div class="float_right">
                <a class="thm-btn style-3" href="{{ $settings['home_cta_btn_link'] ?? route('volunteer') }}">{{ $settings['home_cta_btn_text'] ?? 'Become a Volunteer' }}</a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script src="{{ asset('website/js/rev-slider/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('website/js/rev-slider/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{ asset('website/js/rev-slider/revolution.extension.actions.min.js') }}"></script>
<script src="{{ asset('website/js/rev-slider/revolution.extension.carousel.min.js') }}"></script>
<script src="{{ asset('website/js/rev-slider/revolution.extension.kenburn.min.js') }}"></script>
<script src="{{ asset('website/js/rev-slider/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ asset('website/js/rev-slider/revolution.extension.migration.min.js') }}"></script>
<script src="{{ asset('website/js/rev-slider/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ asset('website/js/rev-slider/revolution.extension.parallax.min.js') }}"></script>
<script src="{{ asset('website/js/rev-slider/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ asset('website/js/rev-slider/revolution.extension.video.min.js') }}"></script>
@endpush
