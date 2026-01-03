@extends('layouts.website')

@section('title', 'Events || Humanity')

@section('content')
<div class="inner-banner has-base-color-overlay text-center" style="background: url({{ asset('website/images/background/4.jpg') }});">
    <div class="container">
        <div class="box">
            <h1>Events</h1>
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
                    Events
                </li>
            </ul>
        </div>
        <div class="pull-right">
            <a href="{{ route('volunteer') }}" class="get-qoute"><i class="fa fa-arrow-circle-right"></i>Become a Volunteer</a>
        </div>
    </div>
</div>

<section class="event-section no-padd style-3">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="event-left-column sec-padd">
                    <div class="row">
                        @forelse($events as $event)
                        <article class="col-md-6 col-sm-6 col-xs-12">
                            <div class="item clearfix">
                                <figure class="img-holder">
                                    <a href="{{ route('events.show', $event->slug) }}"><img src="{{ $event->image ? asset('storage/' . $event->image) : asset('website/images/event/1.jpg') }}" alt="{{ $event->title }}"></a>
                                    <div class="overlay2">
                                        <a href="{{ route('events.show', $event->slug) }}" class="thm-btn">read more</a>
                                    </div>
                                </figure>
                                <div class="lower-content">
                                    <div class="date">{{ $event->start_date->format('d') }} <br><span>{{ $event->start_date->format('M Y') }}</span></div>
                                    <a href="{{ route('events.show', $event->slug) }}"><h3>{{ $event->title }}</h3></a>
                                    <div class="post-meta">
                                        @if($event->start_time)
                                        <i class="fa fa-clock-o"></i>Started On: {{ $event->start_time }} <br>
                                        @endif
                                        @if($event->location)
                                        <i class="fa fa-map-marker"></i> {{ $event->location }}
                                        @endif
                                    </div>
                                </div>   
                            </div>
                        </article>
                        @empty
                        <div class="col-12 text-center">
                            <p>No upcoming events found.</p>
                        </div>
                        @endforelse
                    </div>
                    <div class="mt-4">
                        {{ $events->appends(request()->query())->links('vendor.pagination.website') }}
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="blog-sidebar sec-padd-top">
                    <div class="nav_side_content">
                        {{-- Search Widget --}}
                        <div class="event-filter">
                            <div class="default-form-area all">
                                <form action="{{ route('events.index') }}" method="GET" class="default-form style-5">
                                    <div class="clearfix">
                                        <div class="form-group">
                                            <input type="text" name="search" placeholder="Search...." value="{{ request('search') }}">
                                            <button class="tran3s" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </form>
                                @if(request()->has('search') && request('search') != '')
                                    <div class="clearfix" style="padding-bottom: 30px;">
                                        <a href="{{ route('events.index') }}" class="thm-btn pull-right" style="padding: 10px 20px; line-height: 20px; font-size: 14px;">RESET</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Upcoming Events Widget --}}
                    <div class="event-section2">
                        <div class="section-title style-2">
                            <h4>Upcoming Events</h4>
                        </div>
                        <div class="event-carousel3">
                            @forelse($upcomingEvents as $upcoming)
                            <div class="item">
                                <div class="img-column1">
                                    <figure class="img-holder">
                                        <a href="{{ route('events.show', $upcoming->slug) }}"><img src="{{ $upcoming->image ? asset('storage/' . $upcoming->image) : asset('website/images/resource/12.jpg') }}" alt="{{ $upcoming->title }}" style="width: 80px; height: 70px; object-fit: cover;"></a>
                                    </figure>
                                </div>
                                <div class="text-column1">
                                    <div class="lower-content">
                                        <a href="{{ route('events.show', $upcoming->slug) }}"><h4>{{ Str::limit($upcoming->title, 40) }}</h4></a>
                                        <div class="post-meta"><i class="fa fa-calendar"></i>Started On: {{ $upcoming->start_time ?? 'TBA' }} <br><i class="fa fa-map-marker"></i> {{ $upcoming->location ?? 'TBA' }}</div>                  
                                    </div>
                                </div>  
                            </div>
                            @empty
                            <div class="item">
                                <p>No upcoming events.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- Facebook Feed Widget (Static) --}}
                    <div class="feed-area">
                        <div class="section-title style-2">
                            <h4>Follow On Facebook</h4>
                        </div>
                        <div class="facebook-feed">
                            <figure class="img-box">
                                <img src="{{ asset('website/images/blog/feedbg.jpg') }}" alt="">
                                <div class="overlay">
                                    <div class="inner-box">
                                        <div class="logo"><img src="{{ asset('website/images/logo/1.jpg') }}" alt=""></div>
                                        <h4>The humanity</h4>
                                        <div class="like">890 likes</div>
                                    </div>
                                    <div class="link clearfix">
                                        <a href="#" class="float_left"><i class="fa fa-facebook fb-icon"></i>Like page</a>
                                        <a href="{{ route('contact') }}" class="float_right"><i class="fa fa-envelope mail"></i>contact us</a>
                                    </div>    
                                </div>
                            </figure>
                            <div class="like-people">
                                <p>Be the first of your friends to like this</p>
                                <ul class="list_inline">
                                    <li><a href="#"><img src="{{ asset('website/images/blog/p1.jpg') }}" alt=""></a></li>
                                    <li><a href="#"><img src="{{ asset('website/images/blog/p1.jpg') }}" alt=""></a></li>
                                    <li><a href="#"><img src="{{ asset('website/images/blog/p1.jpg') }}" alt=""></a></li>
                                    <li><a href="#"><img src="{{ asset('website/images/blog/p1.jpg') }}" alt=""></a></li>
                                    <li><a href="#"><img src="{{ asset('website/images/blog/p1.jpg') }}" alt=""></a></li>
                                    <li><a href="#"><img src="{{ asset('website/images/blog/p1.jpg') }}" alt=""></a></li>
                                    <li><a href="#"><img src="{{ asset('website/images/blog/p1.jpg') }}" alt=""></a></li>
                                    <li><a href="#"><img src="{{ asset('website/images/blog/p1.jpg') }}" alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
   </div>
</section>
@endsection
