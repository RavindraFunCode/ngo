@extends('layouts.website')

@section('title', 'Testimonials || Humanity')

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
                @foreach($testimonials as $testimonial)
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <div class="single-testimonial center">
                        <figure class="img-box">
                            <a href="#"><img src="{{ asset('uploads/' . $testimonial->image) }}" alt="{{ $testimonial->name }}"></a>
                        </figure>
                        <div class="content">
                            <div class="text"><p> "{{ Str::limit($testimonial->content, 100) }}" </p></div>
                            <h4>{{ $testimonial->name }}</h4>
                            <p class="author-title"><a href="#"> {{ $testimonial->role }}</a></p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
