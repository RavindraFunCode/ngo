@extends('layouts.website')

@section('title', $post->title . ' || Humanity')

@section('content')
    <div class="inner-banner has-base-color-overlay text-center" style="background: url({{ asset('website/images/background/4.jpg') }});">
        <div class="container">
            <div class="box">
                <h1>{{ $post->title }}</h1>
            </div>
        </div>
    </div>

    <div class="breadcumb-wrapper">
        <div class="container">
            <div class="pull-left">
                <ul class="list-inline link-list">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('blog.index') }}">Blog</a></li>
                    <li>{{ $post->title }}</li>
                </ul>
            </div>
            <div class="pull-right">
                <a class="get-qoute" href="{{ route('volunteer') }}"><i class="fa fa-arrow-circle-right"></i>Become a Volunteer</a>
            </div>
        </div>
    </div>

    <section class="blog-single-post blog-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="post-area sec-padd">
                        <article class="classic-blog-news">
                            <figure class="img-holder">
                                <img src="{{ $post->image ? asset('uploads/' . $post->image) : asset('website/images/blog/l2.jpg') }}" alt="{{ $post->title }}">
                                <div class="inner-box"></div>
                            </figure>
                            <div class="lower-content">
                                <div class="category">{{ $post->category->name ?? 'Uncategorized' }}</div>
                                <div class="content">
                                    <div class="post-meta">
                                        {{ $post->created_at->format('F d, Y') }} | By {{ $post->author->name ?? 'Admin' }}
                                    </div>
                                    <h4>{{ $post->title }}</h4>
                                    <div class="text">
                                        {!! $post->content !!}
                                    </div>
                                    
                                    <div class="share-box clearfix">
                                        <ul class="tag-box pull-left">
                                            <li>Category:</li>
                                            <li><a href="#">{{ $post->category->name ?? 'Uncategorized' }}</a></li>
                                        </ul>
                                        <div class="social-box pull-right">
                                            <span>Share <i class="fa fa-share-alt"></i></span>
                                            <ul class="list-inline social">
                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <div class="content-box">
                            <div class="outer-box">
                                <div class="section-title2">
                                    <h3>About author</h3>
                                </div>
                                <div class="post-author">
                                    <div class="inner-box">
                                        <figure class="author-thumb">
                                            <img src="{{ asset('website/images/blog/author2.jpg') }}" alt="">
                                        </figure>
                                        <h4>{{ $post->author->name ?? 'Admin' }}</h4>
                                        <div class="">
                                            <p>{{ $post->author->bio ?? 'Author bio goes here.' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="blog-sidebar sec-padd">
                        <div class="sidebar_search">
                            <form action="#">
                                <input type="text" placeholder="Search....">
                                <button class="tran3s color1_bg"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </form>
                        </div>

                        <div class="category-style-one">
                            <div class="section-title style-2">
                                <h4>Categories</h4>
                            </div>
                            <ul class="list">
                                @foreach(\App\Models\Category::all() as $category)
                                    <li><a href="#">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <div class="popular_news">
                            <div class="section-title style-2">
                                <h4>Recent News</h4>
                            </div>
                            <div class="popular-post">
                                @foreach(\App\Models\BlogPost::latest()->take(3)->get() as $recentPost)
                                    <div class="item">
                                        <div class="post-thumb">
                                            <a href="{{ route('blog.show', $recentPost->slug) }}">
                                                <img src="{{ $recentPost->image ? asset('uploads/' . $recentPost->image) : asset('website/images/resource/thumb2.jpg') }}" alt="">
                                            </a>
                                        </div>
                                        <a href="{{ route('blog.show', $recentPost->slug) }}"><h4>{{ $recentPost->title }}</h4></a>
                                        <div class="post-info">{{ $recentPost->created_at->format('F d, Y') }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
