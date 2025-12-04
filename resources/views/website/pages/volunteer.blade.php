@extends('layouts.website')

@section('title', 'Join as Volunteer || Humanity')

@section('content')
    <div class="inner-banner has-base-color-overlay text-center" style="background: url({{ asset('website/images/background/4.jpg') }});">
        <div class="container">
            <div class="box">
                <h1>Join as Volunteer</h1>
            </div>
        </div>
    </div>

    <div class="breadcumb-wrapper">
        <div class="container">
            <div class="pull-left">
                <ul class="list-inline link-list">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Join as Volunteer</li>
                </ul>
            </div>
            <div class="pull-right">
                <a class="get-qoute" href="{{ route('volunteer') }}"><i class="fa fa-arrow-circle-right"></i>Become a Volunteer</a>
            </div>
        </div>
    </div>

    <section class="volunteer sec-padd">
        <div class="container">
            <div class="feature-style-one">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="img-box">
                            <img src="{{ asset('website/images/resource/13.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="section-title2">
                            <h3>Ways to volunteer</h3>
                        </div>
                        <div class="text">
                            <p>Humanity has designed several volunteering models to enable individuals get involved in community despite their time constraints. Volunteering is made easy as it caters to the individual’s interests and convenience, time availability and location.</p>
                        </div>
                        <ul class="list-style-one">
                            <li><span>Weekend Volunteering:</span> Spare a few hours on weekends. <br>This is ideal for professionals and college students.</li>
                            <li><span>Weekday Volunteering:</span> Give few hours for 2-3 days during <br>the week. This is suitable for housewives and retirees.</li>
                            <li><span>Humanity Vacation:</span> Volunteer every day for 1 month or <br>more. Typically, college students serve during their semester breaks.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="section-title center">
                <h2>Become a <span class="thm-color">Volunteer</span></h2>
            </div>  
            
            <div class="default-form-area">
                <form id="volunteer-form" name="volunteer_form" class="default-form" action="#" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="default-form-bg">
                                <div class="row clearfix">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" value="" placeholder="Your Name *" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" name="nationality" class="form-control" value="" placeholder="Nationality" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" name="address" class="form-control" value="" placeholder="Address (Including Postcode)">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" name="phone" class="form-control" value="" placeholder="Phn Num">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control required email" value="" placeholder="Email Id *" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <div class="select-box">
                                                <select class="text-capitalize selectpicker form-control required" name="gender" data-style="g-select" data-width="100%">
                                                    <option value="" selected="">Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>      
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <div class="select-box">
                                                <select class="text-capitalize selectpicker form-control required" name="age_group" data-style="g-select" data-width="100%">
                                                    <option value="" selected="">Age</option>
                                                    <option value="<20">Lessthan 20</option>
                                                    <option value="20-30">Between 20 to 30</option>
                                                    <option value="31-40">Between 31 to 40</option>
                                                    <option value=">40">Above 40</option>
                                                </select>
                                            </div>      
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="default-form-bg">
                                <div class="row clearfix">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <div class="select-box">
                                                <select class="text-capitalize selectpicker form-control required" name="availability" data-style="g-select" data-width="100%">
                                                    <option value="" selected="">Your Availability</option>
                                                    <option value="Weekends">Weekends</option>
                                                    <option value="Weekdays">Weekdays</option>
                                                    <option value="Full Time">Full Time</option>
                                                </select>
                                            </div>      
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <div class="select-box">
                                                <select class="text-capitalize selectpicker form-control required" name="interest" data-style="g-select" data-width="100%">
                                                    <option value="" selected="">What Would You Like to do?</option>
                                                    <option value="Teaching">Teaching</option>
                                                    <option value="Fundraising">Fundraising</option>
                                                    <option value="Event Management">Event Management</option>
                                                </select>
                                            </div>      
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <textarea name="experience" class="form-control textarea required" placeholder="Experience, Learning and Skills..."></textarea>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group center">
                            <button class="thm-btn" type="submit" data-loading-text="Please wait...">submit now</button>
                        </div>
                    </div>   
                </form>
            </div>
        </div>
    </section>
@endsection
