@extends('layouts.website')

@section('title', 'About Us || Humanity')

@section('content')
    <div class="inner-banner has-base-color-overlay text-center" style="background: url({{ asset('website/images/background/4.jpg') }});">
        <div class="container">
            <div class="box">
                <h1>About Us</h1>
            </div>
        </div>
    </div>

    <div class="breadcumb-wrapper">
        <div class="container">
            <div class="pull-left">
                <ul class="list-inline link-list">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>About Us</li>
                </ul>
            </div>
            <div class="pull-right">
                <a class="get-qoute" href="{{ route('volunteer') }}"><i class="fa fa-arrow-circle-right"></i>Become a Volunteer</a>
            </div>
        </div>
    </div>

    <section class="about sec-padd2 style-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12 left-column">
                    <div class="row padd-bottom-30">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="img-box"><img alt="" src="{{ asset('website/images/resource/about6.jpg') }}"></div>
                            <div class="content">
                                <p>Idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actually teachings of the great explorer of the truth when you give to Our humanity.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="img-box"><img alt="" src="{{ asset('website/images/resource/about7.jpg') }}"></div>
                            <div class="content">
                                <p>When you give to Our humanity, you know your donation is making a difference. Whether you supporting one of our Signature Programs or our carefully curated list of Gifts That Give More, our professional staff.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="content">
                        <div class="text">
                            <p>When you give to Our humanity, you know your donation is making a difference. Whether you are supporting one of our Signature Programs or our carefully curated list of Gifts That Give More, our professional staff works hard every day<br>
                            to ensure every dolar has impact for the cause of your choice explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.</p>
                        </div>
                        <h3 class="thm-color">Years of Experience</h3>
                        <div class="text">
                            <p>We partner with over 320 amazing projects worldwide, and have given over $150 million in cash and product grants to other groups since 2011. We also operate our own dynamic suite of Signature Programs.</p>
                        </div>
                        <ul>
                            <li><i class="fa fa-check"></i>This mistaken idea of denouncing pleasure</li>
                            <li><i class="fa fa-check"></i>Master-builder of human happiness</li>
                            <li><i class="fa fa-check"></i>Occasionally circumstances occur in toil</li>
                            <li><i class="fa fa-check"></i>Undertakes laborious physical exercise</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="why-chooseus sec-padd-top">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="item">
                        <div class="inner-box">
                            <div class="icon_box"><span class="icon-heart3"></span></div>
                            <a href="#"><h4>25 Years of Experince</h4></a>
                        </div>
                        <div class="text">
                            <p>Actual teachings of the great explorer the truth, the master-builder of human sed happiness one dislikes, or avoids pleasure itself.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="item">
                        <div class="inner-box">
                            <div class="icon_box"><span class="icon-people-1"></span></div>
                            <a href="#"><h4>Good Will Volunteers</h4></a>
                        </div>
                        <div class="text">
                            <p>Installations are becoming more important, but if current trends continue under we seds ut should be looking to seds others solutions.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="item">
                        <div class="inner-box">
                            <div class="icon_box"><span class="icon-favorite"></span></div>
                            <a href="#"><h4>Most Trusted humanity</h4></a>
                        </div>
                        <div class="text">
                            <p>Everyone loves spend time outside with friends and family but as the temperature begins to dip out in the freezing cold.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="fact-counter fact-counter-1 sec-padd" style="background-image: url({{ asset('website/images/background/5.jpg') }});">
        <div class="container">
            <div class="row clearfix">
                <div class="counter-outer clearfix">
                    <article class="column counter-column col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="0ms">
                        <div class="item">
                            <div class="icon"><i class="icon-nature-1"></i></div>
                            <div class="count-outer"><span class="count-text" data-speed="3000" data-stop="30">0</span>+</div>
                            <h4 class="counter-title">Year Of Experience</h4>
                        </div>
                    </article>
                    <article class="column counter-column col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="0ms">
                        <div class="item">
                            <div class="icon"><i class="icon-ribbon"></i></div>
                            <div class="count-outer"><span class="count-text" data-speed="3000" data-stop="2345">0</span></div>
                            <h4 class="counter-title">Successfull Projects</h4>
                        </div>
                    </article>
                    <article class="column counter-column col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="0ms">
                        <div class="item">
                            <div class="icon"><i class="icon-people-1"></i></div>
                            <div class="count-outer"><span class="count-text" data-speed="3000" data-stop="347">0</span></div>
                            <h4 class="counter-title">Team Members</h4>
                        </div>
                    </article>
                    <article class="column counter-column col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="0ms">
                        <div class="item">
                            <div class="icon"><i class="icon-shapes"></i></div>
                            <div class="count-outer"><span class="count-text" data-speed="3000" data-stop="85">0</span>%</div>
                            <h4 class="counter-title">Winning Awards</h4>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
