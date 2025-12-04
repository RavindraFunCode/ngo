@extends('layouts.website')

@section('title', 'Blog || Humanity')

@section('content')
    <div class="inner-banner has-base-color-overlay text-center" style="background: url({{ asset('website/images/background/4.jpg') }});">
        <div class="container">
            <div class="box">
                <h1>Blog</h1>
            </div>
        </div>
    </div>

    <div class="breadcumb-wrapper">
        <div class="container">
            <div class="pull-left">
                <ul class="list-inline link-list">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Blog</li>
                </ul>
            </div>
            <div class="pull-right">
                <a class="get-qoute" href="{{ route('volunteer') }}"><i class="fa fa-arrow-circle-right"></i>Become a Volunteer</a>
            </div>
        </div>
    </div>

    <section class="all-blog blog-section sec-padd2">
        <div class="container">
            <div class="row">
                @foreach($posts as $post)
                    <article class="col-md-4 col-sm-6 col-xs-12">
                        <div class="default-blog-news">
                            <figure class="img-holder">
                                <a href="{{ route('blog.show', $post->slug) }}">
                                    <img src="{{ $post->image ? asset('uploads/' . $post->image) : asset('website/images/blog/1.jpg') }}" alt="{{ $post->title }}">
                                </a>
                                <div class="inner-box"></div>
                            </figure>
                            <div class="overlay">
                                <div class="bottom-box">
                                    <div class="category">{{ $post->category->name ?? 'Uncategorized' }}</div>
                                    <div class="content">
                                        <div class="post-meta">{{ $post->created_at->format('F d, Y') }} | {{ $post->author->name ?? 'Admin' }}</div>
                                        <a href="{{ route('blog.show', $post->slug) }}"><h4>{{ $post->title }}</h4></a>
                                        <div class="text">
                                            <p>{{ Str::limit(strip_tags($post->content), 100) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="lower-content">
                                <div class="category">{{ $post->category->name ?? 'Uncategorized' }}</div>
                                <div class="content">
                                    <div class="post-meta">{{ $post->created_at->format('F d, Y') }} | {{ $post->author->name ?? 'Admin' }}</div>
                                    <a href="{{ route('blog.show', $post->slug) }}"><h4>{{ $post->title }}</h4></a>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="center">
                {{ $posts->links() }}
            </div>
        </div>
    </section>
@endsection
