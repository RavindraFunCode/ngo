@extends('layouts.website')

@section('title', 'Gallery || Humanity')

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
                    @foreach($categories as $category)
                    <li data-filter=".{{ \Illuminate\Support\Str::slug($category) }}">
                        <span>{{ $category }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>            

            <div class="row filter-layout">
                @foreach($galleryItems as $item)
                <article class="col-md-4 col-sm-6 col-xs-12 filter-item {{ \Illuminate\Support\Str::slug($item->category) }}">
                    <div class="item">
                        <img src="{{ asset('uploads/' . $item->image) }}" alt="{{ $item->title }}">
                        <div class="overlay">
                            <div class="top">
                                <div class="box">
                                    <div class="content">
                                        <a data-group="1" href="{{ asset('uploads/' . $item->image) }}" class="img-popup thm-btn">view project</a>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom"><a href="#"><h4>{!! nl2br(e($item->title)) !!}</h4></a></div>
                        </div>
                    </div>
                </article> 
                @endforeach
            </div>
        </div>
    </section>
@endsection
