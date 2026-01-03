@extends('layouts.website')

@section('title', $event->title . ' || Humanity')

@section('content')
<div class="inner-banner has-base-color-overlay text-center" style="background: url({{ asset('website/images/background/4.jpg') }});">
    <div class="container">
        <div class="box">
            <h1>{{ $event->title }}</h1>
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
                    <a href="{{ route('events.index') }}">Events</a>
                </li>
                <li>
                    {{ $event->title }}
                </li>
            </ul>
        </div>
        <div class="pull-right">
            <a href="{{ route('volunteer') }}" class="get-qoute"><i class="fa fa-arrow-circle-right"></i>Become a Volunteer</a>
        </div>
    </div>
</div>

<section class="event-section style-3">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="single-event">
                    <div class="img-box">
                        <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('website/images/event/16.jpg') }}" alt="{{ $event->title }}">
                        {{-- Countdown can be added here if needed, requires JS implementation --}}
                    </div>
                    <div class="content">
                        <div class="text">
                            <p>{!! nl2br(e($event->description)) !!}</p>
                        </div>
                        <br><br>

                        <div class="event-schedule">
                            <div class="section-title2">
                                <h3>Event Details</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <ul class="list2">
                                        <li><i class="fa fa-calendar"></i> <strong>Start Date:</strong> {{ $event->start_date->format('d M Y') }}</li>
                                        @if($event->end_date)
                                        <li><i class="fa fa-calendar"></i> <strong>End Date:</strong> {{ $event->end_date->format('d M Y') }}</li>
                                        @endif
                                        <li><i class="fa fa-clock-o"></i> <strong>Time:</strong> {{ $event->start_time ?? 'TBA' }}</li>
                                    </ul>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <ul class="list2">
                                        <li><i class="fa fa-map-marker"></i> <strong>Location:</strong> {{ $event->location ?? 'TBA' }}</li>
                                        <li><i class="fa fa-user"></i> <strong>Organizer:</strong> {{ $event->organizer ?? 'TBA' }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- Donation Form Area (Visual only for now as requested 'make like same') --}}
                        <div class="donate-form-area">
                            <div class="section-title2">
                                <h3>Leave a Reply</h3>
                            </div>
                            <div class="default-form-area" style="padding: 0;">
                                @if(session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('events.reply', $event->slug) }}" method="post" class="default-form">
                                    @csrf
                                    <div class="row clearfix">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control" placeholder="Your Name *" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-control" placeholder="Your Mail *" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" name="phone" class="form-control" placeholder="Phone">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" name="subject" class="form-control" placeholder="Subject">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <textarea name="message" class="form-control textarea required" placeholder="Your Message...."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <button class="thm-btn" type="submit">send message</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="right-column">
                    <div class="sidebar_widget">
                        <div class="widget_title">
                            <h4>UPCOMING EVENTS</h4>
                        </div>
                        <div class="event-carousel3">
                            @foreach($recentEvents as $recent)
                            <div class="item">
                                <div class="img-column1">
                                    <figure class="img-holder">
                                        <a href="{{ route('events.show', $recent->slug) }}"><img src="{{ $recent->image ? asset('storage/' . $recent->image) : asset('website/images/resource/12.jpg') }}" alt="" style="width: 100%; height: auto;"></a>
                                    </figure>
                                </div>
                                <div class="text-column1">
                                    <div class="lower-content" style="padding: 20px 0;">
                                        <a href="{{ route('events.show', $recent->slug) }}"><h4>{{ $recent->title }}</h4></a>
                                        <div class="post-meta" style="font-size: 14px; color: #888; margin-top: 10px;">
                                            <div style="margin-bottom: 5px;"><i class="fa fa-calendar" style="color: #ff5722; margin-right: 5px;"></i> {{ $recent->start_date->format('d M Y') }}</div>
                                            @if($recent->location)
                                            <div><i class="fa fa-map-marker" style="color: #ff5722; margin-right: 5px;"></i> {{ $recent->location }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
</section>
@endsection
