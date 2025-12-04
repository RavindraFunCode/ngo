@extends('layouts.website')

@section('title', 'Donation Failed || Humanity')

@section('content')
    <div class="inner-banner has-base-color-overlay text-center" style="background: url({{ asset('website/images/background/4.jpg') }});">
        <div class="container">
            <div class="box">
                <h1>Donation Failed</h1>
            </div>
        </div>
    </div>

    <section class="sec-padd text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="section-title center">
                        <h2>Donation <span class="thm-color">Failed</span></h2>
                    </div>
                    <div class="text">
                        <p>Unfortunately, your donation could not be processed. Please try again later.</p>
                        <br>
                        <a href="{{ route('home') }}" class="thm-btn">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
