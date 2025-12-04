@extends('layouts.website')

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
                {{-- Static Team Members for now --}}
                <article class="col-md-3 col-sm-6 col-xs-12">
                    <div class="single-team-member">
                        <figure class="img-box">
                            <a href="#"><img src="{{ asset('website/images/team/t1.jpg') }}" alt=""></a>
                            <div class="overlay">
                                <div class="inner-box">
                                    <ul class="social-icon">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </figure>
                        <div class="author-info">
                            <a href="#"><h4>Felicity BNovak</h4></a>
                            <p>CEO & Founder</p>
                            <ul>
                                <li><i class="fa fa-phone-square"></i>Phone: +123-456-7890</li>
                                <li><i class="fa fa-envelope-square"></i><a href="#">Felicity@Experts.com</a></li>
                            </ul>
                        </div>
                    </div>
                </article>
                <article class="col-md-3 col-sm-6 col-xs-12">
                    <div class="single-team-member">
                        <figure class="img-box">
                            <a href="#"><img src="{{ asset('website/images/team/t2.jpg') }}" alt=""></a>
                            <div class="overlay">
                                <div class="inner-box">
                                    <ul class="social">
                                        <li><a href="#"><i class="fa fa-link"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </figure>
                        <div class="author-info">
                            <a href="#"><h4>Mark Richarson</h4></a>
                            <p>Board of Trustee</p>
                            <ul>
                                <li><i class="fa fa-phone-square"></i>Phone: +123-456-7890</li>
                                <li><i class="fa fa-envelope-square"></i><a href="#">Mark@Experts.com</a></li>
                            </ul>
                        </div>
                    </div>
                </article>
                <article class="col-md-3 col-sm-6 col-xs-12">
                    <div class="single-team-member">
                        <figure class="img-box">
                            <a href="#"><img src="{{ asset('website/images/team/t3.jpg') }}" alt=""></a>
                            <div class="overlay">
                                <div class="inner-box">
                                    <ul class="social">
                                        <li><a href="#"><i class="fa fa-link"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </figure>
                        <div class="author-info">
                            <a href="#"><h4>Jom Caraleno</h4></a>
                            <p>Board of Trustee</p>
                            <ul>
                                <li><i class="fa fa-phone-square"></i>Phone: +123-456-7890</li>
                                <li><i class="fa fa-envelope-square"></i><a href="#">Jom@Experts.com</a></li>
                            </ul>
                        </div>
                    </div>
                </article>
                <article class="col-md-3 col-sm-6 col-xs-12">
                    <div class="single-team-member">
                        <figure class="img-box">
                            <a href="#"><img src="{{ asset('website/images/team/t4.jpg') }}" alt=""></a>
                            <div class="overlay">
                                <div class="inner-box">
                                    <ul class="social">
                                        <li><a href="#"><i class="fa fa-link"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </figure>
                        <div class="author-info">
                            <a href="#"><h4>Asahtan Marsh</h4></a>
                            <p>Board of Advisor</p>
                            <ul>
                                <li><i class="fa fa-phone-square"></i>Phone: +123-456-7890</li>
                                <li><i class="fa fa-envelope-square"></i><a href="#">Asahtan@Experts.com</a></li>
                            </ul>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
@endsection
