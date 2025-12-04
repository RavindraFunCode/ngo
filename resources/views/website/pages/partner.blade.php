@extends('layouts.website')

@section('content')
    <div class="inner-banner has-base-color-overlay text-center" style="background: url({{ asset('website/images/background/4.jpg') }});">
        <div class="container">
            <div class="box">
                <h1>Partner With Us</h1>
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
                        Partner With Us
                    </li>
                </ul>
            </div>
            <div class="pull-right">
                <a href="{{ route('volunteer') }}" class="get-qoute"><i class="fa fa-arrow-circle-right"></i>Become a Volunteer</a>
            </div>
        </div>
    </div>

    <section class="volunteer sec-padd">
        <div class="container">
            <div class="feature-style-one">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="img-box">
                            <img src="{{ asset('website/images/resource/12.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="content">
                            <div class="text">
                                <p>Partnering with Humanity allows your organization to make a significant impact. We collaborate with businesses, other NGOs, and government bodies to achieve common goals.</p>
                                <p>Together, we can create sustainable change and improve lives. Join our network of partners today.</p>
                            </div>
                            <ul class="list-style-one">
                                <li>Corporate Social Responsibility (CSR) partnerships</li>
                                <li>Joint advocacy campaigns</li>
                                <li>Program implementation and support</li>
                            </ul>
                            <div class="link">
                                <a href="{{ route('contact') }}" class="thm-btn style-2">Contact Us to Partner</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
