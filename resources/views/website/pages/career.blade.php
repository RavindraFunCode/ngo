@extends('layouts.website')

@section('title', 'Work With Us || Humanity')

@section('content')
    <div class="inner-banner has-base-color-overlay text-center" style="background: url({{ asset('website/images/background/4.jpg') }});">
        <div class="container">
            <div class="box">
                <h1>Work With Us</h1>
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
                        Work With Us
                    </li>
                </ul>
            </div>
            <div class="pull-right">
                <a href="{{ route('volunteer') }}" class="get-qoute"><i class="fa fa-arrow-circle-right"></i>Become a Volunteer</a>
            </div>
        </div>
    </div>

    <section class="career sec-padd">
        <div class="container">
            <div class="section-title center">
                <h2>Current <span class="thm-color">Openings</span></h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="item-box">
                        <div class="item">
                            <h4>Program Coordinator</h4>
                            <p>Location: New York, NY</p>
                            <p>We are looking for an experienced Program Coordinator to manage our education initiatives.</p>
                            <a href="{{ route('contact') }}" class="thm-btn style-2">Apply Now</a>
                            <hr>
                        </div>
                        <div class="item">
                            <h4>Fundraising Manager</h4>
                            <p>Location: Remote</p>
                            <p>Join our team to lead fundraising efforts and build relationships with donors.</p>
                            <a href="{{ route('contact') }}" class="thm-btn style-2">Apply Now</a>
                            <hr>
                        </div>
                        <div class="item">
                            <p>Don't see a role that fits? Send us your resume at <a href="mailto:careers@humanity.org">careers@humanity.org</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
