@extends('layouts.website')

@section('title', $campaign->title . ' || Humanity')

@section('content')
    <div class="inner-banner has-base-color-overlay text-center" style="background: url({{ asset('website/images/background/4.jpg') }});">
        <div class="container">
            <div class="box">
                <h1>{{ $campaign->title }}</h1>
            </div>
        </div>
    </div>

    <div class="breadcumb-wrapper">
        <div class="container">
            <div class="pull-left">
                <ul class="list-inline link-list">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('campaigns.index') }}">Causes</a></li>
                    <li>{{ $campaign->title }}</li>
                </ul>
            </div>
            <div class="pull-right">
                <a class="get-qoute" href="{{ route('volunteer') }}"><i class="fa fa-arrow-circle-right"></i>Become a Volunteer</a>
            </div>
        </div>
    </div>

    <section class="style-2">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="cause-area urgent-cause2 single-cause cause-list-bg sec-padd">
                        <article class="item clearfix">
                            <figure class="img-box">
                                <img src="{{ $campaign->image ? asset('uploads/' . $campaign->image) : asset('website/images/cause/18.jpg') }}" alt="{{ $campaign->title }}">
                            </figure>
                            <div class="content">
                                <div class="donate"><span>Goal: ${{ number_format($campaign->goal_amount) }} </span><br> Raised: ${{ number_format($campaign->raised_amount) }}</div>
                                <div class="progress-box">
                                    <div class="bar">
                                        <div class="bar-inner animated-bar" data-percent="{{ $campaign->raised_percent }}%"><div class="count-text">{{ $campaign->raised_percent }}%</div></div>
                                    </div>
                                </div>
                            </div>
                        </article><br><br>

                        <div class="section-title">
                            <h2>Cause <span class="thm-color">Description</span></h2>
                        </div>
                        <div class="text">
                            {!! $campaign->description !!}
                        </div><br><br>

                        <div class="share clearfix">
                            <div class="social-box float_left">
                                <span>Share <i class="fa fa-share-alt"></i></span>
                                <ul class="list-inline social">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                </ul>
                            </div>
                            <div class="float_right">
                                <a href="#" class="thm-btn style-2 donate-box-btn">donate us</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="blog-sidebar sec-padd">
                        <div class="sidebar_search">
                            <form action="#">
                                <input type="text" placeholder="Search....">
                                <button class="tran3s color1_bg"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </form>
                        </div>

                        <div class="category-style-one">
                            <div class="section-title style-2">
                                <h4>Categories</h4>
                            </div>
                            <ul class="list">
                                <li><a href="#">Childrens Education</a></li>
                                <li><a href="#">Community humanity</a></li>
                                <li><a href="#">Poor People Life Saving</a></li>
                                <li><a href="#">Environmental Saving</a></li>
                                <li><a href="#">Uncategorized Post</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
