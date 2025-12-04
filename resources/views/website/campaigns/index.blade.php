@extends('layouts.website')

@section('title', 'Causes || Humanity')

@section('content')
    <div class="inner-banner has-base-color-overlay text-center" style="background: url({{ asset('website/images/background/4.jpg') }});">
        <div class="container">
            <div class="box">
                <h1>Causes</h1>
            </div>
        </div>
    </div>

    <div class="breadcumb-wrapper">
        <div class="container">
            <div class="pull-left">
                <ul class="list-inline link-list">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Causes</li>
                </ul>
            </div>
            <div class="pull-right">
                <a class="get-qoute" href="{{ route('volunteer') }}"><i class="fa fa-arrow-circle-right"></i>Become a Volunteer</a>
            </div>
        </div>
    </div>

    <section class="urgent-cause2 sec-padd">
        <div class="container">
            <div class="row">
                @foreach($campaigns as $campaign)
                    <article class="item col-md-4 col-sm-6 col-xs-12">
                        <figure class="img-box">
                            <img src="{{ $campaign->image ? asset('uploads/' . $campaign->image) : asset('website/images/cause/1.jpg') }}" alt="{{ $campaign->title }}">
                            <div class="overlay">
                                <div class="inner-box">
                                    <div class="content-box">
                                        <a href="{{ route('campaigns.show', $campaign->slug) }}" class="thm-btn style-2 donate-box-btn">donate now</a>
                                    </div>
                                </div>
                            </div>
                        </figure>
                        <div class="content">
                            <div class="text center">
                                <a href="{{ route('campaigns.show', $campaign->slug) }}"><h4 class="title">{{ $campaign->title }}</h4></a>
                                <p>{{ Str::limit(strip_tags($campaign->description), 100) }}</p>
                            </div>
                            <div class="progress-box">
                                <div class="bar">
                                    <div class="bar-inner animated-bar" data-percent="{{ $campaign->raised_percent }}%"><div class="count-text">{{ $campaign->raised_percent }}%</div></div>
                                </div>
                            </div>
                            <div class="donate clearfix">
                                <div class="donate float_left"><span>Goal: ${{ number_format($campaign->goal_amount) }} </span></div>
                                <div class="donate float_right">Raised: ${{ number_format($campaign->raised_amount) }}</div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="center">
                {{ $campaigns->links() }}
            </div>
        </div>
    </section>
@endsection
