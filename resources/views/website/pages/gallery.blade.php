@extends('layouts.website')

@section('content')
    <div class="inner-banner has-base-color-overlay text-center" style="background: url({{ asset('website/images/background/4.jpg') }});">
        <div class="container">
            <div class="box">
                <h1>Gallery</h1>
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
                       Gallery
                    </li>
                </ul>
            </div>
            <div class="pull-right">
                <a href="{{ route('volunteer') }}" class="get-qoute"><i class="fa fa-arrow-circle-right"></i>Become a Volunteer</a>
            </div>
        </div>
    </div>

    <section class="gallery sec-padd style-2">
        <div class="container">
            <div class="center">
                <ul class="post-filter list-inline">
                    <li class="active" data-filter=".filter-item">
                        <span>View All</span>
                    </li>
                    <li data-filter=".humanity">
                        <span>Humanity</span>
                    </li>
                    <li data-filter=".Children">
                        <span>Children</span>
                    </li>
                    <li data-filter=".Donate">
                        <span>Donate</span>
                    </li>
                    <li data-filter=".Volunteer">
                        <span>Volunteer</span>
                    </li>
                </ul>
            </div>            

            <div class="row filter-layout">
                <article class="col-md-4 col-sm-6 col-xs-12 filter-item Children">
                    <div class="item">
                        <img src="{{ asset('website/images/project/1.jpg') }}" alt="">
                        <div class="overlay">
                            <div class="top">
                                <div class="box">
                                    <div class="content">
                                        <a data-group="1" href="{{ asset('website/images/project/1.jpg') }}" class="img-popup thm-btn">view project</a>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom"><a href="#"><h4>Clean poor urban areas to protect <br>from pollution.</h4></a></div>
                        </div>
                    </div>
                </article> 
                <article class="col-md-4 col-sm-6 col-xs-12 filter-item Donate">
                    <div class="item">
                        <img src="{{ asset('website/images/project/2.jpg') }}" alt="">
                        <div class="overlay">
                            <div class="top">
                                <div class="box">
                                    <div class="content">
                                        <a data-group="1" href="{{ asset('website/images/project/2.jpg') }}" class="img-popup thm-btn">view project</a>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom"><a href="#"><h4>Clean poor urban areas to protect <br>from pollution.</h4></a></div>
                        </div>
                    </div>
                </article> 
                <article class="col-md-4 col-sm-6 col-xs-12 filter-item humanity">
                    <div class="item">
                        <img src="{{ asset('website/images/project/3.jpg') }}" alt="">
                        <div class="overlay">
                            <div class="top">
                                <div class="box">
                                    <div class="content">
                                        <a data-group="1" href="{{ asset('website/images/project/3.jpg') }}" class="img-popup thm-btn">view project</a>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom"><a href="#"><h4>Clean poor urban areas to protect <br>from pollution.</h4></a></div>
                        </div>
                    </div>
                </article>
                <article class="col-md-4 col-sm-6 col-xs-12 filter-item Volunteer">
                    <div class="item">
                        <img src="{{ asset('website/images/project/4.jpg') }}" alt="">
                        <div class="overlay">
                            <div class="top">
                                <div class="box">
                                    <div class="content">
                                        <a data-group="1" href="{{ asset('website/images/project/4.jpg') }}" class="img-popup thm-btn">view project</a>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom"><a href="#"><h4>Clean poor urban areas to protect <br>from pollution.</h4></a></div>
                        </div>
                    </div>
                </article>
                <article class="col-md-4 col-sm-6 col-xs-12 filter-item humanity Donate">
                    <div class="item">
                        <img src="{{ asset('website/images/project/5.jpg') }}" alt="">
                        <div class="overlay">
                            <div class="top">
                                <div class="box">
                                    <div class="content">
                                        <a data-group="1" href="{{ asset('website/images/project/5.jpg') }}" class="img-popup thm-btn">view project</a>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom"><a href="#"><h4>Clean poor urban areas to protect <br>from pollution.</h4></a></div>
                        </div>
                    </div>
                </article>
                <article class="col-md-4 col-sm-6 col-xs-12 filter-item Children">
                    <div class="item">
                        <img src="{{ asset('website/images/project/6.jpg') }}" alt="">
                        <div class="overlay">
                            <div class="top">
                                <div class="box">
                                    <div class="content">
                                        <a data-group="1" href="{{ asset('website/images/project/6.jpg') }}" class="img-popup thm-btn">view project</a>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom"><a href="#"><h4>Clean poor urban areas to protect <br>from pollution.</h4></a></div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
@endsection
