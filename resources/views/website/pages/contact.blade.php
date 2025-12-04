@extends('layouts.website')

@section('title', 'Contact Us || Humanity')

@section('content')
    <div class="inner-banner has-base-color-overlay text-center" style="background: url({{ asset('website/images/background/4.jpg') }});">
        <div class="container">
            <div class="box">
                <h1>Contact us</h1>
            </div>
        </div>
    </div>

    <div class="breadcumb-wrapper">
        <div class="container">
            <div class="pull-left">
                <ul class="list-inline link-list">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Contact us</li>
                </ul>
            </div>
            <div class="pull-right">
                <a class="get-qoute" href="{{ route('volunteer') }}"><i class="fa fa-arrow-circle-right"></i>Become a Volunteer</a>
            </div>
        </div>
    </div>

    <section class="contact sec-padd2">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="section-title">
                        <h2>Send Your <span class="thm-color">Message</span></h2>
                    </div>
                    <div class="default-form-area">
                        <form id="contact-form" name="contact_form" class="default-form" action="#" method="post">
                            @csrf
                            <div class="row clearfix">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" value="" placeholder="Your Name *" required="">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control required email" value="" placeholder="Your Mail *" required="">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="phone" class="form-control" value="" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="subject" class="form-control" value="" placeholder="Subject">
                                    </div>
                                </div>   
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <textarea name="message" class="form-control textarea required" placeholder="Your Message...."></textarea>
                                    </div>
                                </div>   
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <button class="thm-btn" type="submit" data-loading-text="Please wait...">send message</button>
                                    </div>
                                </div>   
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="section-title">
                        <h2>Quick <span class="thm-color">Contact</span></h2>
                    </div>
                    <div class="content">
                        <div class="text">
                            <p>If you are passionate about helping people: through education, or preventing then you are in the right place. </p>
                        </div>


                        <ul class="contact-info">
                            <li><i class="icon-arrows"></i><span>Address:</span> {{ $settings['contact_address'] ?? '121, humanity Apple Street, New York, NY 10012, USA' }}</li>
                            <li><i class="icon-phone"></i><span> Phone:</span> {{ $settings['contact_phone'] ?? '(123) 0200 12345' }}</li>
                            <li><i class="icon-back"></i><span>Email:</span> {{ $settings['contact_email'] ?? 'Supportus@humanity.com' }}</li>
                        </ul>    
                        <ul class="social-icon">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-feed"></i></a></li>
                            <li><a href="#"><i class="fa fa-skype"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="home-google-map">
        <div 
            class="google-map" 
            id="contact-google-map" 
            data-map-lat="42.568692" 
            data-map-lng="72.930105" 
            data-icon-path="{{ asset('website/images/logo/map-marker.png') }}"
            data-map-title="Chester"
            data-map-zoom="8" >
        </div>
    </section>
@endsection
