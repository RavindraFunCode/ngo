@extends('layouts.website')

@section('title', $page->title . ' || Humanity')

@section('content')
    <div class="inner-banner has-base-color-overlay text-center" style="background: url({{ $page->image ? asset('uploads/' . $page->image) : asset('website/images/background/4.jpg') }});">
        <div class="container">
            <div class="box">
                <h1>{{ $page->title }}</h1>
            </div>
        </div>
    </div>

    @if($page->show_breadcrumb ?? true)
    <div class="breadcumb-wrapper">
        <div class="container">
            <div class="pull-left">
                <ul class="list-inline link-list">
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>
                        {{ $page->title }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @endif

    <section class="sec-padd">
        <div class="container">
            <div class="text">
                {!! $page->content !!}
            </div>
        </div>
    </section>
@endsection
