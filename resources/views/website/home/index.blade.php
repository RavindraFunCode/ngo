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
                    </div>
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

    <!-- Team Section (Style 2) -->
    <section class="team-style-2 sec-padd2">
        <div class="container">
            <div class="section-title">
                <h2>Meet Our <span class="thm-color">Volunteers</span></h2>
            </div>
            <div class="row">
                @foreach($team as $member)
                <article class="item col-md-3 col-sm-6 col-xs-12">
                    <div class="inner-box">
                        <div class="img-box">
                            <img alt="{{ $member->name }}" src="{{ asset('uploads/' . $member->image) }}">
                            <div class="overlay3">
                                <ul class="social-icon">
                                    @if($member->social_links)
                                        @foreach($member->social_links as $platform => $link)
                                        <li><a href="{{ $link }}"><i class="fa fa-{{ $platform }}"></i></a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="author center">
                        <h4>{{ $member->name }}</h4>
                        <p>{{ $member->role }}</p>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Gallery Section (Latest Projects) -->
    <section class="gallery sec-padd">
        <div class="container">
            <div class="section-title center">
                <h2>Latest <span class="thm-color">Projects</span></h2>
            </div>
            <div class="gallery-carousel">
                @foreach($gallery as $item)
                <article class="item">
                    <div class="inner-box">
                        <img alt="{{ $item->title }}" src="{{ asset('uploads/' . $item->image) }}">
                        <div class="overlay">
                            <div class="top">
                                <div class="box">
                                    <div class="content">
                                        <a class="img-popup thm-btn" data-group="1" href="{{ asset('uploads/' . $item->image) }}">view project</a>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom">
                                <a href="#">
                                    <h4>{{ $item->title }}</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Fact Counter (Style 2) -->
    <section class="fact-counter fact-counter-2 sec-padd" style="background-image: url('{{ asset('website/images/background/10.jpg') }}');">
        <div class="container">
            <div class="row clearfix">
                <article class="col-md-6 col-sm-12">
                    <div class="content">
                        <p class="thm-color">Want to join with us</p>
                        <h2>Become a proud volunteer</h2>
                        <p>When you bring together those who have, with those who have not - miracles happen. Become a time hero by volunteering with us. Meet new friends, gain new skills, get happiness and have fun!</p>
                        <div class="link">
                            <a class="thm-btn" href="{{ route('volunteer') }}">Join with us</a>
                        </div>
                    </div>
                </article>
                <article class="col-md-6 col-sm-12">
                    <div class="counter-outer row clearfix">
                        <!--Team Members-->
                        <article class="column counter-column col-md-6 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="0ms">
                            <div class="item clearfix">
                                <div class="icon"><i class="icon-people-1"></i></div>
                                <div class="count-area">
                                    <div class="count-outer"><span class="count-text" data-speed="3000" data-stop="{{ $settings['count_team'] ?? '50' }}">0</span></div>
                                </div>
                                <h4 class="counter-title">Team Members</h4>
                            </div>
                        </article>
                        
                        <!--Winning Awards-->
                        <article class="column counter-column col-md-6 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="0ms">
                            <div class="item clearfix">
                                <div class="icon"><i class="icon-ribbon"></i></div>
                                <div class="count-area">
                                    <div class="count-outer"><span class="count-text" data-speed="3000" data-stop="{{ $settings['count_awards'] ?? '12' }}">0</span></div>
                                </div>
                                <h4 class="counter-title">Winning Awards</h4>
                            </div>
                        </article>

                        <!--Experienced-->
                        <article class="column counter-column col-md-6 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="0ms">
                            <div class="item clearfix">
                                <div class="icon"><i class="icon-nature-1"></i></div>
                                <div class="count-area">
                                    <div class="count-outer"><span class="count-text" data-speed="3000" data-stop="{{ $settings['count_experienced'] ?? '10' }}">0</span></div>
                                </div>
                                <h4 class="counter-title">Experienced</h4>
                            </div>
                        </article>

                        <!--Project Done-->
                        <article class="column counter-column col-md-6 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="0ms">
                            <div class="item clearfix">
                                <div class="icon"><i class="icon-shapes"></i></div>
                                <div class="count-area">
                                    <div class="count-outer"><span class="count-text" data-speed="3000" data-stop="{{ $settings['count_projects'] ?? '150' }}">0</span></div>
                                </div>
                                <h4 class="counter-title">Project Done</h4>
                            </div>
                        </article>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="testimonial-section-one sec-padd" style="background-image: url({{ asset('website/images/background/8.jpg') }});">
        <div class="container">
            <div class="section-title center">
                <h2>Words From <span class="thm-color">People</span></h2>
            </div>
            <div class="inner-container">
                <div class="carousel-outer">
                    <!--Slider Content-->
                    <ul class="testimonial-slider-content">
                        @foreach($testimonials as $testimonial)
                        <li class="slide-item">
                            <h4 class="title">“ {{ Str::limit($testimonial->content, 100) }} ”</h4>
                            <div class="text">
                                {{ $testimonial->content }}
                            </div>
                            <div class="author">
                                <h4>{{ $testimonial->name }}</h4>
                                <p>{{ $testimonial->role }}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    
                    <div class="styled-dots"></div>
                    
                    <div class="pagers-outer">
                        <!--Slider Pager-->
                        <ul class="testimonial-slider-pager">
                            @foreach($testimonials as $testimonial)
                            <li class="pager-item">
                                <div class="inner-box">
                                    <figure class="author-thumb">
                                        <img alt="{{ $testimonial->name }}" src="{{ asset('uploads/' . $testimonial->image) }}">
                                    </figure>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-section sec-padd2">
        <div class="container">
            <div class="section-title center">
                <h2>Latest From <span class="thm-color">News</span></h2>
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
