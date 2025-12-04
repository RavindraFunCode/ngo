@extends('layouts.website')

@section('content')
    <div class="inner-banner has-base-color-overlay text-center" style="background: url({{ asset('website/images/background/4.jpg') }});">
        <div class="container">
            <div class="box">
                <h1>Testimonials</h1>
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
                        Testimonials
                    </li>
                </ul>
            </div>
            <div class="pull-right">
                <a href="{{ route('volunteer') }}" class="get-qoute"><i class="fa fa-arrow-circle-right"></i>Become a Volunteer</a>
            </div>
        </div>
    </div>

    <section class="testimonial-two sec-padd-top">
        <div class="container"> 
            <div class="row masonary-layout">
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <div class="single-testimonial center">
                        <figure class="img-box">
                            <a href="#"><img src="{{ asset('website/images/team/1.png') }}" alt=""></a>
                        </figure>
                        <div class="content">
                            <div class="text"><p> "Humanity has given me a chance to give back to society in a meaningful way. I am proud to be a volunteer." </p></div>
                            <h4>Allen Duckeat</h4>
                            <p class="author-title"><a href="#"> Newyork</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <div class="single-testimonial center">
                        <figure class="img-box">
                            <a href="#"><img src="{{ asset('website/images/team/2.png') }}" alt=""></a>
                        </figure>
                        <div class="content">
                            <div class="text"><p> "The transparency and dedication of this NGO are commendable. I know my donations are reaching the right people." </p></div>
                            <h4>Steve Bairstow </h4>
                            <p class="author-title"><a href="#"> California</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <div class="single-testimonial center">
                        <figure class="img-box">
                            <a href="#"><img src="{{ asset('website/images/team/3.png') }}" alt=""></a>
                        </figure>
                        <div class="content">
                            <div class="text"><p> "Seeing the smiles on the children's faces is the best reward. Thank you Humanity for this opportunity." </p></div>
                            <h4>Sarah Jones</h4>
                            <p class="author-title"><a href="#"> London</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <div class="single-testimonial center">
                        <figure class="img-box">
                            <a href="#"><img src="{{ asset('website/images/team/4.png') }}" alt=""></a>
                        </figure>
                        <div class="content">
                            <div class="text"><p> "A truly inspiring organization. I highly recommend everyone to support their noble cause." </p></div>
                            <h4>Don Flethcer</h4>
                            <p class="author-title"><a href="#"> Detroit</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
