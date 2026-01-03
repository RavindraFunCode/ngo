@extends('layouts.website')

@section('title', 'Terms & Conditions || Humanity')

@section('content')
    <div class="inner-banner has-base-color-overlay text-center" style="background: url({{ asset('website/images/background/4.jpg') }});">
        <div class="container">
            <div class="box">
                <h1>Terms & Conditions</h1>
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
                        Terms & Conditions
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <section class="sec-padd">
        <div class="container">
            <div class="text">
                @php
                    $locale = app()->getLocale();
                    $trans = $page->getTranslation($locale);
                @endphp
                
                @if($trans)
                    {!! $trans->content !!}
                @else
                    <div class="alert alert-warning">Content not available in current language.</div>
                @endif
            </div>
        </div>
    </section>
@endsection
