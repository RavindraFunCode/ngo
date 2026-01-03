@extends('layouts.website')

@section('title', 'Meet Our Team || Humanity')

@section('content')
    <div class="inner-banner has-base-color-overlay text-center" style="background: url({{ asset('website/images/background/4.jpg') }});">
        <div class="container">
            <div class="box">
                <h1>Meet Our Team</h1>
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
                        Meet Our Team
                    </li>
                </ul>
            </div>
            <div class="pull-right">
                <a href="{{ route('volunteer') }}" class="get-qoute"><i class="fa fa-arrow-circle-right"></i>Become a Volunteer</a>
            </div>
        </div>
    </div>

    <section class="team-style-1 sec-padd2">
        <div class="container">
            <div class="section-title center">
                <h2>Meet Our <span class="thm-color">Team</span></h2>
            </div>  
            <div class="row">
                @foreach($members as $member)
                <article class="col-md-3 col-sm-6 col-xs-12">
                    <div class="single-team-member">
                        <figure class="img-box">
                            <a href="#"><img src="{{ \Illuminate\Support\Str::startsWith($member->image, 'website/') ? asset($member->image) : asset('uploads/' . $member->image) }}" alt=""></a>
                            @php
                                $validLinks = collect($member->social_links)->filter(function($link) {
                                    return !empty($link);
                                });
                            @endphp
                            
                            @if($validLinks->isNotEmpty())
                            <div class="overlay">
                                <div class="inner-box">
                                    <ul class="social-icon">
                                        @foreach($validLinks as $platform => $link)
                                            <li><a href="{{ $link }}"><i class="fa fa-{{ $platform }}"></i></a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif
                        </figure>
                        <div class="author-info">
                            <a href="#"><h4>{{ $member->name }}</h4></a>
                            <p>{{ $member->role }}</p>
                            <ul>
                                @if($member->phone)
                                    <li><i class="fa fa-phone-square"></i>Phone: {{ $member->phone }}</li>
                                @endif
                                @if($member->email)
                                    <li><i class="fa fa-envelope-square"></i><a href="mailto:{{ $member->email }}">{{ $member->email }}</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
