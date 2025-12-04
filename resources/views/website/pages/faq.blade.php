@extends('layouts.website')

@section('content')
    <div class="inner-banner has-base-color-overlay text-center" style="background: url({{ asset('website/images/background/4.jpg') }});">
        <div class="container">
            <div class="box">
                <h1>FAQ's</h1>
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
                        FAQ's
                    </li>
                </ul>
            </div>
            <div class="pull-right">
                <a href="{{ route('volunteer') }}" class="get-qoute"><i class="fa fa-arrow-circle-right"></i>Become a Volunteer</a>
            </div>
        </div>
    </div>

    <section class="faq-section sec-padd2">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="accordion-box style-one">
                        <!--Start single accordion box-->
                        <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                            <div class="acc-btn active">
                                <p class="title">What is the process to be a part of humanity?</p>
                                <div class="toggle-icon">
                                    <span class="plus fa fa-angle-right"></span><span class="minus fa fa-angle-down"></span>
                                </div>
                            </div>
                            <div class="acc-content collapsed">
                                <div class="text"><p>
                                    You can join us by filling out the volunteer form on our website. We welcome everyone who wants to make a difference.
                                </p></div>
                            </div>
                        </div>
                        <!--Start single accordion box-->
                        <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                            <div class="acc-btn">
                                <p class="title">What types of project work can I request?</p>
                                <div class="toggle-icon">
                                    <i class="plus fa fa-angle-right"></i><i class="minus fa fa-angle-down"></i>
                                </div>
                            </div>
                            <div class="acc-content">
                                <div class="text"><p>
                                    We work on various projects including education, healthcare, and environmental conservation. You can propose projects that align with our mission.
                                </p></div>
                            </div>
                        </div>
                        <!--Start single accordion box-->
                        <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                            <div class="acc-btn">
                                <p class="title">Where will you send the collected fund?</p>
                                <div class="toggle-icon">
                                    <i class="plus fa fa-angle-right"></i><i class="minus fa fa-angle-down"></i>
                                </div>
                            </div>
                            <div class="acc-content">
                                <div class="text"><p>
                                    All collected funds are directly used for the specific causes mentioned. We maintain transparency and provide reports on fund utilization.
                                </p></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="category-style-one">
                        <div class="inner-title">
                            <h4>Categories</h4>
                        </div>
                        <ul class="list">
                            <li><a href="#">About humanity <span>(8)</span></a></li>
                            <li><a href="#">Become a Volunteer <span>(5)</span></a></li>
                            <li><a href="#">How Can You Help? <span>(3)</span></a></li>
                            <li><a href="#">Safety & Privacy  <span>(4)</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
